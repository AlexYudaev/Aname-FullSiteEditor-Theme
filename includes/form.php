<?php
/**
 * Custom contact form
 *
 * Copyright @ 2023 Alexander Yudaev
 * https://www.alechko.name
 * https://ya.digital
 *

 * Replace default contact form 7 and gravity forms
 *
 * @package aname
 * @since 21.11.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function send_form(){

    $to = "lexx1304@gmail.com";
    $subject = "פנייה חדשה בבלוג"; //todo if post id contact or services [post_id] => 1846

    $message = '<table dir="rtl" width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF"><tbody>';

    $message .= '<tr bgcolor="#EAF2FA"><td colspan="2"><font style="font-family:sans-serif;font-size:12px"><strong>שם מלא:</strong></font></td></tr>';
    $message .= '<tr bgcolor="#FFFFFF"><td width="20">&nbsp;</td><td><font style="font-family:sans-serif;font-size:12px">'. $_POST['fname'] .'</font></td></tr>';

    $message .= '<tr bgcolor="#EAF2FA"><td colspan="2"><font style="font-family:sans-serif;font-size:12px"><strong>טלפון:</strong></font></td></tr>';
    $message .= '<tr bgcolor="#FFFFFF"><td width="20">&nbsp;</td><td><font style="font-family:sans-serif;font-size:12px">'. $_POST['phone'] .'</font></td></tr>';

    $message .= '<tr bgcolor="#EAF2FA"><td colspan="2"><font style="font-family:sans-serif;font-size:12px"><strong>דוא״ל:</strong></font></td></tr>';
    $message .= '<tr bgcolor="#FFFFFF"><td width="20">&nbsp;</td><td><font style="font-family:sans-serif;font-size:12px">'. $_POST['email'] .'</font></td></tr>';

    $message .= '<tr bgcolor="#EAF2FA"><td colspan="2"><font style="font-family:sans-serif;font-size:12px"><strong>טקסט:</strong></font></td></tr>';
    $message .= '<tr bgcolor="#FFFFFF"><td width="20">&nbsp;</td><td><font style="font-family:sans-serif;font-size:12px">'. $_POST['msg'] .'</font></td></tr>';

    $message .= '<tr bgcolor="#EAF2FA"><td colspan="2"><font style="font-family:sans-serif;font-size:12px"><strong>שם העמוד:</strong></font></td></tr>';
    $message .= '<tr bgcolor="#FFFFFF"><td width="20">&nbsp;</td><td><a href="'. $_SERVER['HTTP_REFERER'] .'"><font style="font-family:sans-serif;font-size:12px">'. $_POST['post_name'] .'</font></a></td></tr>';

    $message .= '</tbody></table>';


    $headers = "From:". $_POST['fname']." <". $_POST['email'] ."> \r\n";
    $headers .= "Reply-To: ". $_POST['fname']." <". $_POST['email'] .">\r\n";
    $headers .= "Return-Path: ". $_POST['fname']." <". $_POST['email'] .">\r\n";


    $headers .= "Organization: Website\r\n";
    $headers .= "MIME-Version: 1.0\r\n";

    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP". phpversion() ."\r\n";

    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html\r\n";

    $send_mail = mail($to,$subject,$message,$headers);

    if( $send_mail == true ) {
        $status = ["code" => 200, "text" => __("Message sent successfully...", "aname") ];
    }else {
        $status = ["code" => 404, "text" => __("Message could not be sent...", "aname") ];
    }

    header('Content-Type: application/json');
    wp_die(json_encode($status));
}
add_action("wp_ajax_sendForm", "send_form");
add_action("wp_ajax_nopriv_sendForm", "send_form");
