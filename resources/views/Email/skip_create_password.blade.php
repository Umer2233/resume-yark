<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Resume Yak</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        /* Prevent WebKit and Windows mobile changing default text sizes */
        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        /* Remove spacing between tables in Outlook 2007 and up */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /* Allow smoother rendering of resized image in Internet Explorer */

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width: 525px) {

            /* ALLOWS FOR FLUID TABLES */
            .wrapper {
                width: 100% !important;
                max-width: 100% !important;
            }

            /* ADJUSTS LAYOUT OF LOGO IMAGE */
            .logo img {
                margin: 0 auto !important;
            }

            /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
            .mobile-hide {
                display: none !important;
            }

            .img-max {
                max-width: 100% !important;
                width: 100% !important;
                height: auto !important;
            }

            /* FULL-WIDTH TABLES */
            .responsive-table {
                width: 100% !important;
            }

            /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
            .padding {
                padding: 10px 5% 15px 5% !important;
            }

            .padding-meta {
                padding: 30px 5% 0px 5% !important;
                text-align: center;
            }

            .padding-copy {
                padding: 10px 5% 10px 5% !important;
                text-align: center;
            }

            .no-padding {
                padding: 0 !important;
            }

            .section-padding {
                padding: 50px 15px 50px 15px !important;
            }

            /* ADJUST BUTTONS ON MOBILE */
            .mobile-button-container {
                margin: 0 auto;
                width: 100% !important;
            }

            .mobile-button {
                padding: 15px !important;
                border: 0 !important;
                font-size: 16px !important;
                display: block !important;
            }

        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>
</head>

<body style="margin: 0 !important; padding: 0 !important;">

    <!-- HIDDEN PREHEADER TEXT -->
    <div
        style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
        Welcome to the Best Online Resume Builder
    </div>

    <!-- HEADER -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td bgcolor="#ffffff" align="center">
                <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->

                <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" align="center" style="padding: 5px;">
                <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;"
                    class="responsive-table">
                    <tr>
                        <td>
                            <!-- COPY -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                style="max-width: 500px;" class="wrapper">
                                <tr>
                                    <td align="center" valign="top" style="padding: 30px 0 5px 0;" class="logo">
                                        <a href="{{ MAIL_TEMPLATE_URL }}" target="_blank">
                                            <img alt="Resume Yak Logo"
                                                src="{{ MAIL_TEMPLATE_URL }}builder/images/logo/logo.png" width="150"
                                                height="42.656"
                                                style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;"
                                                border="0">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center"
                                        style="font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #467d86; padding-top: 28px;"
                                        class="padding-copy">Welcome to the Best Online Resume Builder</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#ffffff" align="center" style="padding: 5px 0px 0px 0px;">
                                        <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
                                        <!-- UNSUBSCRIBE COPY -->

                                        <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left"
                                        style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666; text-align:left"
                                        class="padding-copy">Hi {{ $first_name }},</td>
                                </tr>
                                <tr>
                                    <td align="left"
                                        style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666; text-align:left"
                                        class="padding-copy">Welcome to <a href="{{ MAIL_TEMPLATE_URL }}">Resume
                                            Yak</a>! You're on your way to creating resumes that will land you more job
                                        interviews.</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" align="center" style="padding: 15px;" class="padding">
                <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;"
                    class="responsive-table">
                    <tr>
                        <td style="padding: 10px 0 0 0; border-top: 1px solid #9dc5cc;">
                            <!-- TWO COLUMNS -->
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td valign="top" class="mobile-wrapper">
                                        <!-- LEFT COLUMN -->
                                        <table cellpadding="0" cellspacing="0" border="0" width="37%"
                                            style="width: 37%;" align="left">
                                            <tr>
                                                <td style="padding: 0 0 10px 0;">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                        width="100%">
                                                        <tr>
                                                            <td align="left"
                                                                style="font-family: Arial, sans-serif; color: #467d86; font-size: 16px;">
                                                                <strong>Account Email</strong>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- RIGHT COLUMN -->
                                        <table cellpadding="0" cellspacing="0" border="0" width="57%"
                                            style="width: 57%;" align="right">
                                            <tr>
                                                <td style="padding: 0 0 10px 0;">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                        width="100%">
                                                        <tr>
                                                            <td align="right"
                                                                style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">
                                                                {{ $email }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0 0 0; border-top: 1px solid #9dc5cc;">
                            <!-- TWO COLUMNS -->
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td valign="top" style="padding: 0;" class="mobile-wrapper">
                                        <!-- LEFT COLUMN -->
                                        <table cellpadding="0" cellspacing="0" border="0" width="20%"
                                            style="width: 20%;" align="left">
                                            <tr>
                                                <td style="padding: 0 0 10px 0;">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                        width="100%">
                                                        <tr>
                                                            <td align="left"
                                                                style="font-family: Arial, sans-serif; color: #467d86; font-size: 16px;">
                                                                <strong>Password</strong>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- RIGHT COLUMN -->
                                        <table cellpadding="0" cellspacing="0" border="0" width="77%"
                                            style="width: 77%;" align="right">
                                            <tr>
                                                <td style="padding: 0 0 10px 0;">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                        width="100%">
                                                        <tr>
                                                            <td align="left"
                                                                style="font-family: Arial, sans-serif; color: #333333; font-size: 15px;">
                                                                <a
                                                                    href="{{ MAIL_TEMPLATE_URL }}builder/create-password/{{ $token }}">Setup
                                                                    your password</a> so that you can return again and
                                                                again to Resume Yak for more resume creating fun!

                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td align="left"
                                        style="padding: 10px 0 10px 0; font-size: 12px; line-height: 20px; font-family: Helvetica, Arial, sans-serif; color: #666666;">
                                        If the password link is giving you trouble, copy and paste the following link
                                        into your
                                        browser:<br>{{ MAIL_TEMPLATE_URL }}create-password/{{ $token }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <td
                            style="padding: 10px 0 0 0; border-top: 1px solid #9dc5cc; border-bottom: 1px solid #9dc5cc;">
                            <!-- TWO COLUMNS -->
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td valign="top" style="padding: 0;" class="mobile-wrapper">
                                        <!-- LEFT COLUMN -->
                                        <table cellpadding="0" cellspacing="0" border="0" width="20%"
                                            style="width: 20%;" align="left">
                                            <tr>
                                                <td style="padding: 0 0 10px 0;">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                        width="100%">
                                                        <tr>
                                                            <td align="left"
                                                                style="font-family: Arial, sans-serif; color: #467d86; font-size: 16px;">
                                                                <strong>Support</strong>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- RIGHT COLUMN -->
                                        <table cellpadding="0" cellspacing="0" border="0" width="77%"
                                            style="width: 77%;" align="right">
                                            <tr>
                                                <td style="padding: 0 0 10px 0;">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                        width="100%">
                                                        <tr>
                                                            <td align="left"
                                                                style="font-family: Arial, sans-serif; color: #333333; font-size: 15px;">
                                                                Our support has been compared to eating hard dried yak
                                                                cheese. It takes a while to chew but is considered a
                                                                delight (by some). Email us at support@resumeyak.com if
                                                                you need help. We promise not to harass you too much.
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>


                </table>
                <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" align="center" style="padding: 15px;">
                <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;"
                    class="responsive-table">
                    <tr>
                        <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>
                                        <!-- COPY -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="left"
                                                    style="padding: 0 0 0 0; font-size: 14px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color: #333333; "
                                                    class="padding-copy"><strong>THIS EMAIL CONTAINS A LINK THAT
                                                        PROVIDES ACCESS TO YOUR ACCOUNT. DO NOT SHARE IT - Unless you
                                                        want someone to quote your accomplishments at your next birthday
                                                        party.</strong></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" align="center" style="padding: 15px;">
                <!-- TWO COLUMNS -->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;"
                    class="wrapper">
                    <tr>
                        <td valign="top" style="padding: 0;" class="mobile-wrapper">
                            <!-- LEFT COLUMN -->
                            <table cellpadding="0" cellspacing="0" border="0" width="57%"
                                style="width: 57%;" align="left">
                                <tr>
                                    <td style="padding: 0 0 10px 0;">
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tr>
                                                <td align="left"
                                                    style="font-family: Arial, sans-serif; color: #666666; font-size: 12px;">
                                                    This email was intended for {{ $first_name }}
                                                    {{ $last_name }}<br><a style="color: #666666;"
                                                        href="Unscubscribe link">Unsubscribe</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <!-- RIGHT COLUMN -->
                            <table cellpadding="0" cellspacing="0" border="0" width="37%"
                                style="width: 37%;" align="right">
                                <tr>
                                    <td style="padding: 0 0 10px 0;">
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tr>
                                                <td align="right"
                                                    style="font-family: Arial, sans-serif; color: #666666; font-size: 12px;">
                                                    © {{ $year }} <a href="{{ config('constant.MAIL_TEMPLATE_URL') }}/builder">Resume
                                                        Yak</a><br>500 Westover Dr #12353<br> Sanford, NC 27330</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>

</body>

</html>
