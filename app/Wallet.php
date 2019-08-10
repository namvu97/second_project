<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{

    public $timestamps = false;
    protected $table = 'wallet';
    protected $primaryKey = 'id';
    protected $fillable = array(
        "id",
        "wallet_name",
        "account_number",
        "current_balance",
        "user_id",
    );

    public function user()
    {
        return $this->belongsTo('App\User', 'id');
    }
    public function walletOne($oldFromWallet, $oldAmount)
    {
        $walletOne = Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$oldFromWallet, session("user_id")])->first();
        return self::whereRaw("wallet_name = ? AND user_id = ?", [$oldFromWallet, session("user_id")])->update(array("current_balance" => $walletOne->current_balance + $oldAmount));
    }
    public function walletTwo($oldToWallet, $oldAmount)
    {
        $walletTwo = Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$oldToWallet, session("user_id")])->first();
        return self::whereRaw("wallet_name = ? AND user_id = ?", [$oldToWallet, session("user_id")])->update(array("current_balance" => $walletTwo->current_balance - $oldAmount));
    }
}
