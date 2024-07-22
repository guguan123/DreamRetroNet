<?php
if($this->request->isPost()){
    $action = $this->request->param('action');
    $email = $this->request->param('email');
    if(empty($email)){
        return JsonResult::error('请输入邮箱号');
    }
    if(Member::iModel()->where('email',$email)->count()){
        return JsonResult::error('该邮箱号不可用');
    }
    if($action === 'send_code'){
        $code = rand(100000,999999);
        try {
            list($status, $msg) = Helper::sendEmail($email, '某图库验证码', '您的验证码为：{code}，验证码5分钟内有效。', ['code'=>$code],[
                'nickname'=>'图库',
                'username'=>'',
                'password'=>''
            ]);
            if(!$status){
                throw new \Exception($msg);
            }
        }catch(\Exception $e){
            return JsonResult::ok('验证码发送失败: '.$e->getMessage());
        }
        Session::set('registerCode', $code);
        Session::set('registerEndTime', time() + 300);
        Session::set('registerEmail', $email);
        return JsonResult::ok('验证码发送成功');
    }
    if($action === 'check_code'){
        $username = $this->request->param('username');
        $code = $this->request->param('code');
        if(empty($code)){
            return JsonResult::error('验证码不能为空');
        }
        if(strlen($code) !== 6){
            return JsonResult::error('验证码错误');
        }
        $registerEmail = Session::get('registerEmail');
        if($registerEmail !== $email){
            return JsonResult::error('注册邮箱不匹配');
        }
        $registerCode = Session::get('registerCode');
        if(empty($registerCode)){
            return JsonResult::error('验证码已过期');
        }
        $registerEndTime = Session::get('registerEndTime');
        if($registerEndTime < time()){
            return JsonResult::error('验证码已过期,请重新发送');
        }
        if((int)$registerCode !== (int)$code){
            return JsonResult::error('验证码错误');
        }
        $password = input('password');
        $model = Member::iModel();
        $model->save([
            'username'=>$username,
            'email'   =>$email,
            'password'=>md5($password),
            'vipEndtime'=>null
        ]);
        Session::delete('registerCode');
        Session::delete('registerEndTime');

        $userKey = md5(uniqid());
        Session::set('UserID', $model->id);
        Session::set('UserInfo', $model->toArray());
        Session::set('UserKey', $userKey);
        return JsonResult::ok('注册成功',['user_key'=>$userKey]);
    }
}