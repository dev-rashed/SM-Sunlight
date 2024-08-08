<html><head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Simple Transactional Email</title>
  <style>
    /* -------------------------------------
        GLOBAL RESETS
    ------------------------------------- */

    /*All the styling goes here*/

    img {
      border: none;
      -ms-interpolation-mode: bicubic;
      max-width: 100%;
    }

    body {
      background-color: #f6f6f6;
      font-family: sans-serif;
      -webkit-font-smoothing: antialiased;
      font-size: 14px;
      line-height: 1.4;
      margin: 0;
      padding: 0;
      -ms-text-size-adjust: 100%;
      -webkit-text-size-adjust: 100%;
    }

    table {
      border-collapse: border;
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
      width: 100%; }
      table td {
        font-family: sans-serif;
        font-size: 16px;
        vertical-align: top;
    }

    /* -------------------------------------
        BODY & CONTAINER
    ------------------------------------- */

    .body {
      background-color: #f6f6f6;
      width: 100%;
    }

    /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
    .container {
      display: block;
      margin: 0 auto !important;
      /* makes it centered */
      max-width: 580px;
      padding: 10px;
      width: 580px;
    }

    /* This should also be a block element, so that it will fill 100% of the .container */
    .content {
      box-sizing: border-box;
      display: block;
      margin: 0 auto;
      max-width: 580px;
      padding: 10px;
    }

    /* -------------------------------------
        HEADER, FOOTER, MAIN
    ------------------------------------- */
    .main {
      background: #ffffff;
      border-radius: 3px;
      width: 100%;
    }

    .wrapper {
      box-sizing: border-box;
      padding: 20px;
    }

    .content-block {
      padding-bottom: 10px;
      padding-top: 10px;
    }

    .footer {
      clear: both;
      margin-top: 10px;
      text-align: center;
      width: 100%;
    }
      .footer td,
      .footer p,
      .footer span,
      .footer a {
        color: #999999;
        font-size: 12px;
        text-align: center;
    }

    /* -------------------------------------
        TYPOGRAPHY
    ------------------------------------- */
    h1,
    h2,
    h3,
    h4 {
      color: #000000;
      font-family: sans-serif;
      font-weight: 400;
      line-height: 1.4;
      margin: 0;
      margin-bottom: 30px;
    }

    h1 {
      font-size: 35px;
      font-weight: 300;
      text-align: center;
      text-transform: capitalize;
    }

    p,
    ul,
    ol {
      font-family: sans-serif;
      font-size: 14px;
      font-weight: normal;
      margin: 0;
      margin-bottom: 15px;
    }
      p li,
      ul li,
      ol li {
        list-style-position: inside;
        margin-left: 5px;
    }

    a {
      color: #3498db;
      text-decoration: underline;
    }

    /* -------------------------------------
        BUTTONS
    ------------------------------------- */
    .btn {
      box-sizing: border-box;
      width: 100%; }
      .btn > tbody > tr > td {
        padding-bottom: 15px; }
      .btn table {
        width: auto;
    }
      .btn table td {
        background-color: #ffffff;
    }
      .btn a {
        background-color: #ffffff;
        border: solid 1px #3498db;
        border-radius: 5px;
        box-sizing: border-box;
        color: #3498db;
        cursor: pointer;
        display: inline-block;
        font-size: 14px;
        font-weight: bold;
        margin: 0;
        padding: 12px 25px;
        text-decoration: none;
        text-transform: capitalize;
    }

    .btn-primary a {
      background-color: #3498db;
      border-color: #3498db;
      color: #ffffff;
    }

    /* -------------------------------------
        OTHER STYLES THAT MIGHT BE USEFUL
    ------------------------------------- */
    .last {
      margin-bottom: 0;
    }

    .first {
      margin-top: 0;
    }

    .align-center {
      text-align: center;
    }

    .align-right {
      text-align: right;
    }

    .align-left {
      text-align: left;
    }

    .clear {
      clear: both;
    }

    .mt0 {
      margin-top: 0;
    }

    .mb0 {
      margin-bottom: 0;
    }

    .preheader {
      color: transparent;
      display: none;
      height: 0;
      max-height: 0;
      max-width: 0;
      opacity: 0;
      overflow: hidden;
      mso-hide: all;
      visibility: hidden;
      width: 0;
    }

    .powered-by a {
      text-decoration: none;
    }

    hr {
      border: 0;
      border-bottom: 1px solid #f6f6f6;
      margin: 20px 0;
    }


    /* -------------------------------------
        RESPONSIVE AND MOBILE FRIENDLY STYLES
    ------------------------------------- */
    @media only screen and (max-width: 620px) {
      table.body h1 {
        font-size: 28px !important;
        margin-bottom: 10px !important;
      }
      table.body p,
      table.body ul,
      table.body ol,
      table.body td,
      table.body span,
      table.body a {
        font-size: 16px !important;
      }
      table.body .wrapper,
      table.body .article {
        padding: 10px !important;
      }
      table.body .content {
        padding: 0 !important;
      }
      table.body .container {
        padding: 0 !important;
        width: 100% !important;
      }
      table.body .main {
        border-left-width: 0 !important;
        border-radius: 0 !important;
        border-right-width: 0 !important;
      }
      table.body .btn table {
        width: 100% !important;
      }
      table.body .btn a {
        width: 100% !important;
      }
      table.body .img-responsive {
        height: auto !important;
        max-width: 100% !important;
        width: auto !important;
      }
    }

    /* -------------------------------------
        PRESERVE THESE STYLES IN THE HEAD
    ------------------------------------- */
    @media all {
      .ExternalClass {
        width: 100%;
      }
      .ExternalClass,
      .ExternalClass p,
      .ExternalClass span,
      .ExternalClass font,
      .ExternalClass td,
      .ExternalClass div {
        line-height: 100%;
      }
      .apple-link a {
        color: inherit !important;
        font-family: inherit !important;
        font-size: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
        text-decoration: none !important;
      }
      #MessageViewBody a {
        color: inherit;
        text-decoration: none;
        font-size: inherit;
        font-family: inherit;
        font-weight: inherit;
        line-height: inherit;
      }
      .btn-primary a:hover {
        background-color: #34495e !important;
        border-color: #34495e !important;
      }
    }
    .single-border,
    .single-border tr,
    .single-border td,
    .single-border th {
      border: 2px solid rgb(145, 145, 145);
      border-collapse: collapse;
    }
    .single-border td,
    .single-border tr,
    .single-border th {
      padding: 4px;
    }

  </style>
</head>
<body>
  <span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
    <tbody>

      <tr>
      <td>&nbsp;</td>
      <td class="container">
        <div class="content">

          <!-- START CENTERED WHITE CONTAINER -->
          <table role="presentation" class="main">

            <!-- START MAIN CONTENT AREA -->
            <tbody>
              <tr>
                <td colspan="2">
                  <p style="background: #ddd; padding: 10px; font-size: 20px; text-align: center">New Customer</p>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <p style="margin-top: 10px; padding-left: 20px; margin-bottom: 0px"><strong>Customer Detalis</strong></p>
                </td>
              </tr>
              <tr>
              <td class="wrapper" style="padding-top: 0px">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                  <tbody><tr>
                    <td>
                      <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                        <tbody>
                          <tr>
                            <td align="left">
                              <table role="presentation" class="single-border">
                                <tbody>
                                  <tr>
                                    <td style="">Name</td>
                                    <td>{{ $customer->name }}</td>
                                  </tr>
                                  <tr>
                                    <td>Date </td>
                                    <td>{{ $customer->date }}</td>
                                  </tr>
                                  <tr>
                                    <td>Phone </td>
                                    <td>{{ $customer->phone }}</td>
                                  </tr>
                                  <tr>
                                    <td>Address </td>
                                    <td>{{ $customer->address }}</td>
                                  </tr>
                                  <tr>
                                    <td>Battery Type </td>
                                    <td>{{ @$customer->battery_type }}</td>
                                  </tr>
                                  <tr>
                                    <td>Comment</td>
                                    <td>{{ @$customer->comment }}</td>
                                  </tr>
                                  <tr>
                                    <td>Selfie</td>
                                    <td><img style="max-width: 120px" src="{{ asset('selfies/'. $customer->selfie) }}" alt=""></td>
                                  </tr>
                                  <tr>
                                    <td>Map Screenshot</td>
                                    <td><img style="max-width: 120px" src="{{ asset('map_screenshot/'. $customer->map) }}" alt=""></td>
                                  </tr>

                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <a href="{{route('customers.show', $customer->id)}}" target="_blank">View Application</a>
                      <p>Thank you so much</p>
                    </td>
                  </tr>
                </tbody></table>
              </td>
            </tr>

          <!-- END MAIN CONTENT AREA -->
          </tbody></table>
          <!-- END CENTERED WHITE CONTAINER -->

        </div>
      </td>
      <td>&nbsp;</td>
    </tr>
  </tbody></table>



</body></html>
