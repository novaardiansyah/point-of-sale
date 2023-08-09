<?php 
  $email_must_hide = (int) ((strpos($email, '@') * 70) / 100);
  $email           = str_replace(substr($email, 0, $email_must_hide), str_repeat('*', $email_must_hide), $email);

  $password_length = strlen($password);
  $password        = str_replace(substr($password, 0, $password_length), str_repeat('*', $password_length), $password);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title></title>
    <!--[if (mso 16)]>
							<style type="text/css">
    a {text-decoration: none;}
    </style>
							<![endif]-->
    <!--[if gte mso 9]>
							<style>sup { font-size: 100% !important; }</style>
							<![endif]-->
    <!--[if gte mso 9]>
							<xml>
								<o:OfficeDocumentSettings>
									<o:AllowPNG></o:AllowPNG>
									<o:PixelsPerInch>96</o:PixelsPerInch>
								</o:OfficeDocumentSettings>
							</xml>
							<![endif]-->
    <style>
      /* CONFIG STYLES Please do not delete and edit CSS styles below */
      /* IMPORTANT THIS STYLES MUST BE ON FINAL EMAIL */
      #outlook a {
        padding: 0;
      }

      .es-button {
        text-decoration: none !important;
      }

      a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
      }

      .es-desk-hidden {
        display: none;
        float: left;
        overflow: hidden;
        width: 0;
        max-height: 0;
        line-height: 0;
      }

      /*
END OF IMPORTANT
*/
      body {
        width: 100%;
        font-family: arial, 'helvetica neue', helvetica, sans-serif;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
      }

      table {
        border-collapse: collapse;
        border-spacing: 0px;
      }

      table td,
      body,
      .es-wrapper {
        padding: 0;
        Margin: 0;
      }

      .es-content,
      .es-header,
      .es-footer {
        table-layout: fixed !important;
        width: 100%;
      }

      img {
        display: block;
        border: 0;
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
      }

      p,
      hr {
        Margin: 0;
      }

      h1,
      h2,
      h3,
      h4,
      h5 {
        Margin: 0;
        line-height: 120%;
        font-family: arial, 'helvetica neue', helvetica, sans-serif;
      }

      p,
      ul li,
      ol li,
      a {
        -webkit-text-size-adjust: none;
        -ms-text-size-adjust: none;
      }

      .es-left {
        float: left;
      }

      .es-right {
        float: right;
      }

      .es-p5 {
        padding: 5px;
      }

      .es-p5t {
        padding-top: 5px;
      }

      .es-p5b {
        padding-bottom: 5px;
      }

      .es-p5l {
        padding-left: 5px;
      }

      .es-p5r {
        padding-right: 5px;
      }

      .es-p10 {
        padding: 10px;
      }

      .es-p10t {
        padding-top: 10px;
      }

      .es-p10b {
        padding-bottom: 10px;
      }

      .es-p10l {
        padding-left: 10px;
      }

      .es-p10r {
        padding-right: 10px;
      }

      .es-p15 {
        padding: 15px;
      }

      .es-p15b {
        padding-bottom: 15px;
      }

      .es-p15l {
        padding-left: 15px;
      }

      .es-p15r {
        padding-right: 15px;
      }

      .es-p20 {
        padding: 20px;
      }

      .es-p15t{
        padding-top: 15px;
      }

      .es-p20t {
        padding-top: 20px;
      }

      .es-p20b {
        padding-bottom: 20px;
      }

      .es-p20l {
        padding-left: 20px;
      }

      .es-p20r {
        padding-right: 20px;
      }

      .es-p25 {
        padding: 25px;
      }

      .es-p25t {
        padding-top: 25px;
      }

      .es-p25b {
        padding-bottom: 25px;
      }

      .es-p25l {
        padding-left: 25px;
      }

      .es-p25r {
        padding-right: 25px;
      }

      .es-p30 {
        padding: 30px;
      }

      .es-p30t {
        padding-top: 30px;
      }

      .es-p30b {
        padding-bottom: 30px;
      }

      .es-p30l {
        padding-left: 30px;
      }

      .es-p30r {
        padding-right: 30px;
      }

      .es-p35 {
        padding: 35px;
      }

      .es-p35t {
        padding-top: 35px;
      }

      .es-p35b {
        padding-bottom: 35px;
      }

      .es-p35l {
        padding-left: 35px;
      }

      .es-p35r {
        padding-right: 35px;
      }

      .es-p40 {
        padding: 40px;
      }

      .es-p40t {
        padding-top: 40px;
      }

      .es-p40b {
        padding-bottom: 40px;
      }

      .es-p40l {
        padding-left: 40px;
      }

      .es-p30r {
        padding-right: 30px;
      }

      .es-menu td {
        border: 0;
      }

      .es-menu td a img {
        display: inline-block !important;
        vertical-align: middle;
      }

      /*
END CONFIG STYLES
*/
      s {
        text-decoration: line-through;
      }

      p,
      ul li,
      ol li {
        font-family: arial, 'helvetica neue', helvetica, sans-serif;
        line-height: 150%;
      }

      ul li,
      ol li {
        Margin-bottom: 15px;
        margin-left: 0;
      }

      a {
        text-decoration: underline;
      }

      .es-menu td a {
        text-decoration: none;
        display: block;
        font-family: arial, 'helvetica neue', helvetica, sans-serif;
      }

      .es-wrapper {
        width: 100%;
        height: 100%;
        background-repeat: repeat;
        background-position: center top;
      }

      .es-wrapper-color,
      .es-wrapper {
        background-color: #fafafa;
      }

      .es-header {
        background-color: transparent;
        background-repeat: repeat;
        background-position: center top;
      }

      .es-header-body {
        background-color: transparent;
      }

      .es-header-body p,
      .es-header-body ul li,
      .es-header-body ol li {
        color: #333333;
        font-size: 14px;
      }

      .es-header-body a {
        color: #666666;
        font-size: 14px;
      }

      .es-content-body {
        background-color: #ffffff;
      }

      .es-content-body p,
      .es-content-body ul li,
      .es-content-body ol li {
        color: #333333;
        font-size: 14px;
      }

      .es-content-body a {
        color: #5c68e2;
        font-size: 14px;
      }

      .es-footer {
        background-color: transparent;
        background-repeat: repeat;
        background-position: center top;
      }

      .es-footer-body {
        background-color: #ffffff;
      }

      .es-footer-body p,
      .es-footer-body ul li,
      .es-footer-body ol li {
        color: #333333;
        font-size: 12px;
      }

      .es-footer-body a {
        color: #333333;
        font-size: 12px;
      }

      .es-infoblock,
      .es-infoblock p,
      .es-infoblock ul li,
      .es-infoblock ol li {
        line-height: 120%;
        font-size: 12px;
        color: #cccccc;
      }

      .es-infoblock a {
        font-size: 12px;
        color: #cccccc;
      }

      h1 {
        font-size: 46px;
        font-style: normal;
        font-weight: bold;
        color: #333333;
      }

      h2 {
        font-size: 26px;
        font-style: normal;
        font-weight: bold;
        color: #333333;
      }

      h3 {
        font-size: 20px;
        font-style: normal;
        font-weight: normal;
        color: #333333;
      }

      .es-header-body h1 a,
      .es-content-body h1 a,
      .es-footer-body h1 a {
        font-size: 46px;
      }

      .es-header-body h2 a,
      .es-content-body h2 a,
      .es-footer-body h2 a {
        font-size: 26px;
      }

      .es-header-body h3 a,
      .es-content-body h3 a,
      .es-footer-body h3 a {
        font-size: 20px;
      }

      a.es-button,
      button.es-button {
        padding: 10px 30px 10px 30px;
        display: inline-block;
        background: #5c68e2;
        border-radius: 5px;
        font-size: 20px;
        font-family: arial, 'helvetica neue', helvetica, sans-serif;
        font-weight: normal;
        font-style: normal;
        line-height: 120%;
        color: #ffffff;
        text-decoration: none;
        width: auto;
        text-align: center;
      }

      .es-button-border {
        border-style: solid solid solid solid;
        border-color: #2cb543 #2cb543 #2cb543 #2cb543;
        background: #5c68e2;
        border-width: 0px 0px 0px 0px;
        display: inline-block;
        border-radius: 5px;
        width: auto;
      }

      /* RESPONSIVE STYLES Please do not delete and edit CSS styles below. If you don't need responsive layout, please delete this section. */
      @media only screen and (max-width: 600px) {

        p,
        ul li,
        ol li,
        a {
          line-height: 150% !important;
        }

        h1,
        h2,
        h3,
        h1 a,
        h2 a,
        h3 a {
          line-height: 120% !important;
        }

        h1 {
          font-size: 36px !important;
          text-align: left;
        }

        h2 {
          font-size: 26px !important;
          text-align: left;
        }

        h3 {
          font-size: 20px !important;
          text-align: left;
        }

        .es-header-body h1 a,
        .es-content-body h1 a,
        .es-footer-body h1 a {
          font-size: 36px !important;
          text-align: left;
        }

        .es-header-body h2 a,
        .es-content-body h2 a,
        .es-footer-body h2 a {
          font-size: 26px !important;
          text-align: left;
        }

        .es-header-body h3 a,
        .es-content-body h3 a,
        .es-footer-body h3 a {
          font-size: 20px !important;
          text-align: left;
        }

        .es-menu td a {
          font-size: 12px !important;
        }

        .es-header-body p,
        .es-header-body ul li,
        .es-header-body ol li,
        .es-header-body a {
          font-size: 14px !important;
        }

        .es-content-body p,
        .es-content-body ul li,
        .es-content-body ol li,
        .es-content-body a {
          font-size: 14px !important;
        }

        .es-footer-body p,
        .es-footer-body ul li,
        .es-footer-body ol li,
        .es-footer-body a {
          font-size: 14px !important;
        }

        .es-infoblock p,
        .es-infoblock ul li,
        .es-infoblock ol li,
        .es-infoblock a {
          font-size: 12px !important;
        }

        *[class="gmail-fix"] {
          display: none !important;
        }

        .es-m-txt-c,
        .es-m-txt-c h1,
        .es-m-txt-c h2,
        .es-m-txt-c h3 {
          text-align: center !important;
        }

        .es-m-txt-r,
        .es-m-txt-r h1,
        .es-m-txt-r h2,
        .es-m-txt-r h3 {
          text-align: right !important;
        }

        .es-m-txt-l,
        .es-m-txt-l h1,
        .es-m-txt-l h2,
        .es-m-txt-l h3 {
          text-align: left !important;
        }

        .es-m-txt-r img,
        .es-m-txt-c img,
        .es-m-txt-l img {
          display: inline !important;
        }

        .es-button-border {
          display: inline-block !important;
        }

        a.es-button,
        button.es-button {
          font-size: 20px !important;
          display: inline-block !important;
        }

        .es-adaptive table,
        .es-left,
        .es-right {
          width: 100% !important;
        }

        .es-content table,
        .es-header table,
        .es-footer table,
        .es-content,
        .es-footer,
        .es-header {
          width: 100% !important;
          max-width: 600px !important;
        }

        .es-adapt-td {
          display: block !important;
          width: 100% !important;
        }

        .adapt-img {
          width: 100% !important;
          height: auto !important;
        }

        .es-m-p0 {
          padding: 0 !important;
        }

        .es-m-p0r {
          padding-right: 0 !important;
        }

        .es-m-p0l {
          padding-left: 0 !important;
        }

        .es-m-p0t {
          padding-top: 0 !important;
        }

        .es-m-p0b {
          padding-bottom: 0 !important;
        }

        .es-m-p20b {
          padding-bottom: 20px !important;
        }

        .es-mobile-hidden,
        .es-hidden {
          display: none !important;
        }

        tr.es-desk-hidden,
        td.es-desk-hidden,
        table.es-desk-hidden {
          width: auto !important;
          overflow: visible !important;
          float: none !important;
          max-height: inherit !important;
          line-height: inherit !important;
        }

        tr.es-desk-hidden {
          display: table-row !important;
        }

        table.es-desk-hidden {
          display: table !important;
        }

        td.es-desk-menu-hidden {
          display: table-cell !important;
        }

        .es-menu td {
          width: 1% !important;
        }

        table.es-table-not-adapt,
        .esd-block-html table {
          width: auto !important;
        }

        table.es-social {
          display: inline-block !important;
        }

        table.es-social td {
          display: inline-block !important;
        }

        .es-m-p5 {
          padding: 5px !important;
        }

        .es-m-p5t {
          padding-top: 5px !important;
        }

        .es-m-p5b {
          padding-bottom: 5px !important;
        }

        .es-m-p5r {
          padding-right: 5px !important;
        }

        .es-m-p5l {
          padding-left: 5px !important;
        }

        .es-m-p10 {
          padding: 10px !important;
        }

        .es-m-p10t {
          padding-top: 10px !important;
        }

        .es-m-p10b {
          padding-bottom: 10px !important;
        }

        .es-m-p10r {
          padding-right: 10px !important;
        }

        .es-m-p10l {
          padding-left: 10px !important;
        }

        .es-m-p15 {
          padding: 15px !important;
        }

        .es-m-p15t {
          padding-top: 15px !important;
        }

        .es-m-p15b {
          padding-bottom: 15px !important;
        }

        .es-m-p15r {
          padding-right: 15px !important;
        }

        .es-m-p15l {
          padding-left: 15px !important;
        }

        .es-m-p20 {
          padding: 20px !important;
        }

        .es-m-p20t {
          padding-top: 20px !important;
        }

        .es-m-p20r {
          padding-right: 20px !important;
        }

        .es-m-p20l {
          padding-left: 20px !important;
        }

        .es-m-p25 {
          padding: 25px !important;
        }

        .es-m-p25t {
          padding-top: 25px !important;
        }

        .es-m-p25b {
          padding-bottom: 25px !important;
        }

        .es-m-p25r {
          padding-right: 25px !important;
        }

        .es-m-p25l {
          padding-left: 25px !important;
        }

        .es-m-p30 {
          padding: 30px !important;
        }

        .es-m-p30t {
          padding-top: 30px !important;
        }

        .es-m-p30b {
          padding-bottom: 30px !important;
        }

        .es-m-p30r {
          padding-right: 30px !important;
        }

        .es-m-p30l {
          padding-left: 30px !important;
        }

        .es-m-p35 {
          padding: 35px !important;
        }

        .es-m-p35t {
          padding-top: 35px !important;
        }

        .es-m-p35b {
          padding-bottom: 35px !important;
        }

        .es-m-p35r {
          padding-right: 35px !important;
        }

        .es-m-p35l {
          padding-left: 35px !important;
        }

        .es-m-p40 {
          padding: 40px !important;
        }

        .es-m-p40t {
          padding-top: 40px !important;
        }

        .es-m-p40b {
          padding-bottom: 40px !important;
        }

        .es-m-p40r {
          padding-right: 40px !important;
        }

        .es-m-p40l {
          padding-left: 40px !important;
        }

        .es-desk-hidden {
          display: table-row !important;
          width: auto !important;
          overflow: visible !important;
          max-height: inherit !important;
        }
      }

      /* END RESPONSIVE STYLES */
    </style>
  </head>
  <body>
    <div class="es-wrapper-color">
      <!--[if gte mso 9]>
								<v:background
									xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
									<v:fill type="tile" color="#fafafa"></v:fill>
								</v:background>
								<![endif]-->
      <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="esd-email-paddings" valign="top">
              <table cellpadding="0" cellspacing="0" class="es-content esd-header-popover" align="center">
                <tbody>
                  <tr>
                    <td class="esd-stripe" align="center">
                      <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600">
                        <tbody>
                          <tr>
                            <td class="esd-structure es-p15t es-p20r es-p20l" align="left">
                              <table cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                  <tr>
                                    <td width="560" class="esd-container-frame" align="center" valign="top">
                                      <table cellpadding="0" cellspacing="0" width="100%">
                                        <tbody>
                                          <tr>
                                            <td align="center" class="esd-block-image es-p30t es-p10b" style="font-size: 0px;">
                                              <a target="_blank">
                                                <img src="https://xttxma.stripocdn.email/content/guids/CABINET_f3fc38cf551f5b08f70308b6252772b8/images/96671618383886503.png" alt style="display: block;" width="100">
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td align="center" class="esd-block-text es-m-txt-c es-p20t es-p15b es-p30r es-p30l es-m-p5r es-m-p5l" esd-links-underline="none">
                                              <h1>Thanks for joining us!</h1>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td align="center" class="esd-block-text es-p20t es-p15b es-p30r es-p30l es-m-p5r es-m-p5l">
                                              <p style="font-size: 16px;">Hey there, <?= $fullname; ?>! <br />Welcome to the family! You've officially joined us, and that's awesome news. It means you're on the fast track to getting all the juiciest updates and hottest offers straight from us. How cool is that?</p>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td class="esd-structure esdev-adapt-off es-p20" align="left">
                              <table width="560" cellpadding="0" cellspacing="0" class="esdev-mso-table">
                                <tbody>
                                  <tr>
                                    <td class="esdev-mso-td" valign="top">
                                      <table cellpadding="0" cellspacing="0" class="es-left" align="left">
                                        <tbody>
                                          <tr class="es-mobile-hidden">
                                            <td width="146" class="esd-container-frame" align="left">
                                              <table cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                  <tr>
                                                    <td align="center" class="esd-block-spacer" height="40"></td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                    <td class="esdev-mso-td" valign="top">
                                      <table cellpadding="0" cellspacing="0" class="es-left" align="left">
                                        <tbody>
                                          <tr>
                                            <td width="121" class="esd-container-frame" align="left">
                                              <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#e8eafb" style="background-color: #e8eafb; border-radius: 10px 0 0 10px; border-collapse: separate;">
                                                <tbody>
                                                  <tr>
                                                    <td align="right" class="esd-block-text es-p10t">
                                                      <p>Email:</p>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td align="right" class="esd-block-text">
                                                      <p>Username:</p>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td align="right" class="esd-block-text es-p10b">
                                                      <p>Password:</p>
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                    <td class="esdev-mso-td" valign="top">
                                      <table cellpadding="0" cellspacing="0" class="es-left" align="left">
                                        <tbody>
                                          <tr>
                                            <td width="250" align="left" class="esd-container-frame">
                                              <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#e8eafb" style="background-color: #e8eafb; border-radius:0 10px 10px 0; border-collapse: separate;">
                                                <tbody>
                                                  <tr>
                                                    <td align="left" class="esd-block-text es-p10t es-p10l">
                                                      <p>
                                                        <strong><?= $email; ?></strong>
                                                      </p>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" class="esd-block-text es-p10l">
                                                      <p>
                                                        <strong><?= $username; ?></strong>
                                                      </p>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" class="esd-block-text es-p10b es-p10l">
                                                      <p>
                                                        <strong><i><?= $password; ?></i></strong>
                                                      </p>
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                    <td class="esdev-mso-td" valign="top">
                                      <table cellpadding="0" cellspacing="0" class="es-right" align="right">
                                        <tbody>
                                          <tr class="es-mobile-hidden">
                                            <td width="138" class="esd-container-frame" align="left">
                                              <table cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                  <tr>
                                                    <td align="center" class="esd-block-spacer" height="40"></td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td class="esd-structure es-p10b es-p20r es-p20l" align="left">
                              <table cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                  <tr>
                                    <td width="560" class="esd-container-frame" align="center" valign="top">
                                      <table cellpadding="0" cellspacing="0" width="100%" style="border-radius: 5px; border-collapse: separate;">
                                        <tbody>
                                          <tr>
                                            <td align="center" class="esd-block-text es-p10t es-p10b es-p30r es-p30l es-m-p5r es-m-p5l">
                                              <p style="font-size: 16px;">As you've likely noticed, your username is currently system-generated  functional, but not the coolest, right? No worries, though! You can rock a username that suits your style and is totally easy to remember. Feel free to switch it up whenever you're ready!</p>
                                            </td>
                                          </tr>

                                          <tr>
                                            <td align="center" class="esd-block-text es-p20t es-p10b es-p30r es-p30l es-m-p5r es-m-p5l">
                                              <p style="line-height: 150%;">Got a burning question or just want to say hi? We're all ears at <a href="mailto:admin@novaardiansyah.site">admin@novaardiansyah.site</a> or you can give us a buzz at <a href="https://wa.me/6289506668480?text=Hi%20Nova%2C%20I%20would%20like%20to%20connect%20with%20you%20soon!">+62 895 0666 8480</a>. We're here to make your experience amazing. </p>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td align="right" class="esd-block-text es-p25t es-p10b es-p30r es-p30l es-m-p5r es-m-p5l">
                                              <p style="line-height: 150%;">Kind Regards, <br type="_moz"></p>
                                              <p>
                                                <br>
                                              </p>
                                              <p style="line-height: 150%;">Nova Ardiansyah <br type="_moz">
                                              </p>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
              <table cellpadding="0" cellspacing="0" class="es-footer esd-footer-popover" align="center">
                <tbody>
                  <tr>
                    <td class="esd-stripe" align="center">
                      <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="640" style="background-color: transparent;">
                        <tbody>
                          <tr>
                            <td class="esd-structure es-p20t es-p20b es-p20r es-p20l" align="left">
                              <table cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                  <tr>
                                    <td width="600" class="esd-container-frame" align="left">
                                      <table cellpadding="0" cellspacing="0" width="100%">
                                        <tbody>
                                          <tr>
                                            <td align="center" class="esd-block-social es-p15t es-p15b" style="font-size:0">
                                              <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social">
                                                <tbody>
                                                  <tr>
                                                    <td align="center" valign="top" class="es-p30r">
                                                      <a target="_blank" href="https://www.facebook.com/Nova981/">
                                                        <img title="Facebook" src="https://novaardiansyah.site/assets/img/icon/facebook.png" alt="facebook" width="28" />
                                                      </a>
                                                    </td>
                                                    <td align="center" valign="top" class="es-p30r">
                                                      <a target="_blank" href="https://www.instagram.com/novaardiansyah._/">
                                                        <img title="Instagram" src="https://novaardiansyah.site/assets/img/icon/instagram.png" alt="instagram" width="28" />
                                                      </a>
                                                    </td>
                                                    <td align="center" valign="top" class="es-p30r">
                                                      <a target="_blank" href="https://www.linkedin.com/in/novaardiansyah/">
                                                        <img title="Linkedin" src="https://novaardiansyah.site/assets/img/icon/linkedin.png" alt="linkedin" width="28" />
                                                      </a>
                                                    </td>
                                                    <td align="center" valign="top">
                                                      <a target="_blank" href="https://github.com/novaardiansyah/">
                                                        <img title="Github" src="https://novaardiansyah.site/assets/img/icon/github.png" alt="github" width="28" />
                                                      </a>
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td align="center" class="esd-block-text es-p35b">
                                              <p>Nova Ardiansyah&nbsp;© 2023. All Rights Reserved.</p>
                                              <p>Tangerang Selatan, Banten, Indonesia.</p>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>