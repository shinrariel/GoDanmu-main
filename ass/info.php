function testAction(){
        $url = 'http://127.0.0.1:7172/1/push/all';
        $post_data['name']       = 'test1';
        $post_data['msg_body']      = 'cmbohpffXVR03nIpkkQXaAA1Vf5nO4nQ';
        $o = "";
        foreach ( $post_data as $k => $v ) 
        { 
            $o.= "$k=" . urlencode( $v ). "&" ;
        }
        $post_data = substr($o,0,-1);

        $res = $this->request_post($url, $post_data);       
        print_r($res);
    }