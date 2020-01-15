<?php

namespace App\Http\Controllers\Auth;
use App\User;
use Auth;
use Socialite;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class TwitterController extends Controller
{
    use AuthenticatesUsers;

    //ログイン
    public function  redirectToProvider(){
        return Socialite::driver('twitter')->redirect();
    }

    //コールバック
    public function handleProviderCallback(){
        try {
            $twitterUser = Socialite::driver('twitter')->user();
            //Log::debug("出力！");
            //Log::debug(print_r($twitterUser, true));
        }catch(Exception $e){
            return redirect('/')->withErrors('ユーザー情報の取得に失敗しました。');
        }

        //ログインしているかチェック
        if(Auth::check()){
            $user_id = Auth::user()->id;
            //ユーザーを探す
            $user_date = User::Where('id',$user_id)->first();
            //Log::debug(print_r($user_date, true)); //ユーザー情報

            $user_date->fill([ //ログインしているアカウントにツイッター情報登録
                'twitter_id' => $twitterUser->id,
                'handle' => $twitterUser->nickname,
                'avatar' => $twitterUser->avatar_original,
                'token' => $twitterUser->token,
                'tokensecret' => $twitterUser->tokenSecret
                ])->save();
                Auth::login($user_date, true);
                return redirect('/');
                
              }else{
                //---------ログインしていない場合、findorcreateメソッドを実施
                $newuser_date = $this->findOrCreateUser($twitterUser);
                Auth::login($newuser_date, true);
                return redirect('/');
             }
             //Log::debug($twitterUser->token);
               return redirect('/');
         }


    //ログインしていない状態でツイッターデータのあるカラムを探し、なければ作るメソッド！
    private function findOrCreateUser($twitterUser){
        Log::debug(print_r("findOrCreateUser実施", true));
        $user_date = User::where('twitter_id',$twitterUser->id)->first();
        //ツイッターのidがすでにテーブルにあれば同じツイッターidのユーザー情報を返す
        if($user_date){
          //Log::debug(print_r("twiiteridがDBにあり", true));
          $user_date->fill([
            'twitter_id' => $twitterUser->id,
            'handle' => $twitterUser->nickname,
            'avatar' => $twitterUser->avatar_original,
            'token' => $twitterUser->token,
            'tokensecret' => $twitterUser->tokenSecret
            ])->save();
          return $user_date;
        }else{
          //なければそのまま作成。
          //Log::debug(print_r("twiiteridがDBになし", true));
          return User::create([
            'twitter_id' => $twitterUser->id,
            'handle' => $twitterUser->nickname,
            'avatar' => $twitterUser->avatar_original,
            'token' => $twitterUser->token,
            'tokensecret' => $twitterUser->tokenSecret
          ]);
        }
      }



        // ログアウト
    public function logout(Request $request)
    {
        // 各自ログアウト処理
        // 例
        // Auth::logout();
        return redirect('/');
    }


}
