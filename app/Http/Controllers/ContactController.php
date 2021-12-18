<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Rules\Recaptcha;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'guestName' => 'required|string',
                'guestEmail' => 'required|string',
                'guestTitle' => 'required|string',
                'guestContent' => 'required|string',
                //Google reCAPTCHA驗證
                'recaptchaToken' => ['required', 'string', new Recaptcha()],
            ],
            [
                // error messages
                'guestName.required' => '姓名格式伺服器驗證錯誤',
                'guestEmail.required' => '信箱格式伺服器驗證錯誤',
                'guestTitle.required' => '主旨格式伺服器驗證錯誤',
                'guestContent.required' => '內容格式伺服器驗證錯誤',
            ]);

            //寫入Contact資料
            $contact = new Contact();
            $contact->name = $data['guestName'];
            $contact->email = $data['guestEmail'];
            $contact->title = $data['guestTitle'];
            $contact->content = $data['guestContent'];

            if ($contact->save()) {
                return '感謝您的留言!';
            } else {
                return '留言失敗!';
            }
        } catch (ValidationException $exception) {
            // 取得 laravel Validator 實例
            $validatorInstance = $exception->validator;
            // 取得錯誤資料
            $errorMessageData = $validationInstance->getMessageBag();
            // 取得驗證錯誤訊息
            $errorMessages = $errorMessageData->getMessages();
            
            return $errorMessages;
        }
        
    }

}
