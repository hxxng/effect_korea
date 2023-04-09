<?php
//쇼핑몰
Class Mall_class
{
    protected $config;

    public function __construct($config)
    {
        $this->db = $config['db'];
        $this->mt_idx = $config['mt_idx'];
    }

    public function detail($idx)
    {
        $result = $this->content_info($idx);

        if($result == "false") {
            p_alert("존재하지 않는 상품입니다.", "./mall.php");
        }

        if($this->mt_idx > 0){
            //찜하기
		    $row = $this->db->fetch_query("select count(0) as cnt from wish_product_t where pt_idx = ".$idx." and mt_idx=".$this->mt_idx." and wpt_status='Y'");
		    $result['wish'] = $row['cnt'];
            //회원정보
            $result['member'] = $this->db->fetch_query("select * from member_t where idx=".$this->mt_idx);
        }else{
            $result['wish'] = 0;
        }        
        return $result;
    }

    //결제완료
    public function complete($ot_code)
    {
        $query = "select * from order_t where ot_code = '".$ot_code."' and mt_idx=".$this->mt_idx;
        $result['order'] = $this->db->fetch_query($query);
        $query = "select *, (select ct_image from contents_t where idx = ct_idx) as ct_image from cart_t where ot_code =  '".$ot_code."' and mt_idx=".$this->mt_idx;
        $result['cart'] = $this->db->select_query($query);
        return $result;
    }

    public function content_info($idx)
    {
        $result = $this->db->fetch_query("select *, idx as ct_idx from contents_t where idx=".$idx);
        if($result['ct_show'] == 'N' || $result['ct_status'] == 1 || $result['ct_status'] == 3) {
            return 'false';
        } else {
            return $result;
        }
    }

    public function product_like($idx)
    {
		$list = array();
		if($this->mt_idx){
			$query = "select * from wish_product_t where mt_idx = ".$this->mt_idx." and pt_idx = ".$idx;
			$list = $this->db->fetch_assoc($query);
		}
        return $list;
    }

	//장바구니
	public function cart($act, $arr)
	{
		$content = $this->content_info($arr['ct_idx']);
        
        $cart_ing = $this->db->fetch_assoc("select * from cart_t where ct_idx = ".$arr['ct_idx']." and mt_idx=".$this->mt_idx." and ct_select = 0 and ct_direct != 1 and ct_status=0");
        if($cart_ing['idx'] > 0 && $arr['order_act']!='direct'){
            return 'same_cart';
        }

        if($arr['order_act']=='direct'){
			$this->db->del_query('order_t', "ot_code='".$ot_code."' and ot_status=1");
            $this->db->del_query('cart_t', "ot_code='".$ot_code."' and ct_direct=1");
            $this->cart_reset();
            $ot_code = get_ot_code();
        } else{
            $cart = $this->db->fetch_assoc("select * from cart_t where mt_idx=".$this->mt_idx." and ct_direct=0 and ct_select=0 and ct_status=0 limit 1");  //기존 주문번호 조회
            $ot_code = ($cart['ot_code']) ? $cart['ot_code'] : get_ot_code();
        }

		$field_arr = array();
        $field_arr['ot_code'] = $ot_code;
		$field_arr['ot_pcode'] = get_ot_pcode();
		$field_arr['mt_idx'] = $this->mt_idx;
		$field_arr['ct_idx'] = $arr['ct_idx'];
		$field_arr['pt_title'] = $content['ct_title'];

        $arr_point = array(
            '4K' => 100,
            'Drone' => 100,
            'Time lapse' => 100,
            '3D illustration' => 100,
            '2D illustration' => 50,
            'HD' => 50,
            'image1' => 40,
            'Motion' => 40,
            'Transition' => 40,
            'illustration' => 40,
            'image2' => 30,
            'LUT' => 30,
        );
        $query = "select *, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx2) as ct_name from contents_t where idx = ".$arr['ct_idx'];
        $contents = $this->db->fetch_assoc($query);
        if($contents) {
            $point = $arr_point[$contents['ct_name']];
        } else {
            $point = 0;
        }

        $field_arr['ct_point'] = (int)$point;

        if($_SESSION['_lang'] == "en") {
            $url = 'https://quotation-api-cdn.dunamu.com/v1/forex/recent?codes=FRX.KRWUSD';
            $result = get_exchange_rate($url);
            $data = json_decode($result,true);
            $data = $data[0];

            $_provider = $data['provider'];

            $_buying = $data['cashBuyingPrice'];
            $_selling = $data['cashSellingPrice'];
            $_ttselling = $data['ttSellingPrice'];
            $_ttbuyling = $data['ttBuyingPrice'];
            $_usd = $data['basePrice'];
            $_openusd = $data['openingPrice'];
            $_chusd = $data['changePrice'];
            $_openusd_o = $_usd - $_openusd;
            $_openusd_op = ($_chusd/$_usd)*100;
            $_openusd = round($_openusd,2);

            $dollar = sprintf('%0.2f',$_usd);
            $ct_price = $content['ct_price'] / $dollar;
        } else {
            $ct_price = $content['ct_price'];
        }

		$field_arr['pt_price'] = $ct_price;	//상품가
		$field_arr['ct_price'] = $ct_price;		//총 금액 = 상품가 + 옵션가
		$field_arr['ct_wdate'] = date('Y-m-d H:i:s');	//등록일시
        if($arr['order_act']=='direct'){    //바로구매
            $field_arr['ct_direct'] = '1';  //바로구매
            if($_POST["membership"] == "membership") {
                $field_arr['ct_select'] = '2';  //장바구니
                $field_arr['ct_status'] = '2';  //arr_ct_status 참조
            } else {
                $field_arr['ct_select'] = '1';  //장바구니
                $field_arr['ct_status'] = '0';  //arr_ct_status 참조
            }
            $field_arr['ct_select_wdate'] = date('Y-m-d H:i:s');
        }
		if($this->db->insert_query("cart_t", $field_arr)){
            if($_POST["membership"] == "membership") {
                $field_arr = array();
                $field_arr['ot_code'] = $ot_code;
                $field_arr['mt_idx'] = $this->mt_idx;
                $field_arr['ot_pay_type'] = 6;
                $field_arr['ot_status'] = 2;
                $field_arr['ot_vat'] = $ct_price * 0.1;
                $field_arr['ot_price'] = $ct_price;	//상품가
                $field_arr['ot_wdate'] = date('Y-m-d H:i:s');	//등록일시
                $field_arr['ot_pdate'] = date('Y-m-d H:i:s');	//결제일시
                $field_arr['ot_point'] = $point;
                $query = "select * from membership_t where mt_status in (2,3) and mt_idx = ".$_SESSION['_mt_idx'];
                $membership = $this->db->fetch_assoc($query." order by mt_pdate desc limit 1");
                $field_arr['mt_type'] = $membership['mt_type'];

                if($this->db->insert_query("order_t", $field_arr)) {
                    $query = "select * from member_t where idx = ".$_SESSION['_mt_idx'];
                    $member = $this->db->fetch_assoc($query);
                    if($member['mt_level'] == 3) {
                        $page = "my_orderlist.php";
                    } else {
                        $page = "artist_my_orderlist.php";
                    }

                    $title = $contents['ct_title'];
                    $this->db->insert_query("pushnotification_log_t", array("plt_title" => "‘".$title."’를 구매하였습니다. 구매 후 2주간 다운로드가 가능합니다.", "plt_type" => 2, "op_idx" => $_SESSION['_mt_idx'], "plt_page" => $page, "plt_wdate" => "now()"));

                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
		}else{
			return false;
		}
	}

    //장바구니 선택필드 초기화
    public function cart_reset()
    {
        $this->db->update_query("cart_t", array('ct_select'=>'0'), "mt_idx=".$this->mt_idx." and ct_select=1");
    }

    public function act($act)
    {
        $list = $this->$act();
        if(is_array($list)){
            return $list;
        }else{
            return array();
        }
    }
}
?>
