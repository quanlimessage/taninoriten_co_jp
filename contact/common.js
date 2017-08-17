// JavaScript Document

/////////////////////////////////////
// 汎用確認メッセージ
/////////////////////////////////////
function ConfirmMsg(msg) {
    return (confirm(msg)) ? true : false;
}

/////////////////////////////////////////////////////////////////////////////////
// 未入力及び不正入力のチェック（※Safariのバグ（エスケープ文字認識）を回避）
/////////////////////////////////////////////////////////////////////////////////
function inputChk(f, confirm_flg) {

    // フラグの初期化
    var flg = false;
    var error_mes = "Error Message\r\n恐れ入りますが、下記の内容を確認してください。\r\n\r\n";

    if (!f.inquiry_item.value) {
        error_mes += "・お問い合わせ項目を選択してください。\r\n";
        flg = true;
    }

    if (!f.name.value) {
        error_mes += "・お名前を入力してください。\r\n";
        flg = true;
    }

    if (!f.kana.value) {
        error_mes += "・フリガナを入力してください。\r\n";
        flg = true;
    }

    // メールアドレス欄が１つならfalse。２つならtrue。
    if (!f.email.value) {
        error_mes += "・メールアドレスを入力してください。\r\n"; flg = true;
    }
    else if (!f.email.value.match(/^[^@]+@[^.]+\..+/)) {
        error_mes += "・メールアドレスの形式に誤りがあります。\r\n"; flg = true;
    }

    if (!f.comment.value) {
        error_mes += "・お問い合わせ内容を入力してください。\r\n";
        flg = true;
    }

    if (!confirm_flg) {
        if (!f.agreement.checked) {
            error_mes += "・「個人情報保護方針」の内容に同意されておりません。\r\n"; flg = true;
        }
    }

    // 判定
    if (flg) {
        // アラート表示して再入力を警告
        window.alert(error_mes);
        return false;
    } else {

        // 確認メッセージ
        if (confirm_flg) {
            return ConfirmMsg('入力いただいた内容で送信します。\nよろしいですか？');
        }
        return true;
    }

}
