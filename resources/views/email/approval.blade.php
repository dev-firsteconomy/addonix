<html>
    <head>
        <title>New Lead Approval Email</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,700;1,400&display=swap" rel="stylesheet">
    </head>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-weight: 300;
        }
        p {
            margin:0;
        }
        table {
            width:350px;
            margin: 15px 0 0 15px;
        }
        table , td, th {
            border: 1px solid #595959;
            border-collapse: collapse;
        }
        td, th {
            padding: 5px;
            width: 30px;
            height: 25px;
        }
        th {
            background: #f0e6cc;
        }
        .even {
            background: #fbf8f0;
        }
        .odd {
            background: #fefcf9;
        }
        tr td:not(:nth-child(3)){
            font-weight:700;
        }

        tr td:nth-child(2) {
            width: 60%;
        }
    </style>
    <body style="font-family: 'Open Sans', sans-serif; font-weight: 300;">
        <p style="margin:0">Dear Sir,</p>
        <p style="margin:0">Greetings.</p>
        <p style="margin:0">Please find the below details. Kindly approve the same. </p>
        <table style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;width:350px;margin: 15px 0 15px 15px;">
            <tbody>
                <tr>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">Sr. No.</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">Description</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;"><b>Details</b></td>
                </tr>
                <tr>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">1</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">Account Name</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;">{{@$data['company_name']?: '-'}}</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">2</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">Parent / Sister / Group Company name</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;">{{@$data['parent_companyy_name'] ?: '-'}}</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">3</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">Full Address</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;">{{@$data['lead_address'] ?: '-'}}</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">4</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">Website</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;">{{@$data['website'] ?: '-'}}</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">5</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">Existing Customer</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;">{{@$data['existing_customer'] ?: '-'}}</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">6</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">CBI’s identified</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;">{{@$data['cbi_identified'] ?: '-'}}</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">7</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">Met or Spoken on phone</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;">{{@$data['met_or_spoke'] ?: '-'}}</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">8</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">Whom did you speak to</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;">{{@$data['poc_name'] ?: '-'}}</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">9</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">Name</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;">{{@$data['is_mnc'] ?: '-'}}</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">10</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;font-weight: bold">Name</td>
                    <td style="padding: 5px; border: 1px solid #595959; border-collapse: collapse;">{{@$data['product_name'] ?: '-'}}</td>
                </tr>
            </tbody>
        </table>
        <p style="font-weight:700; color: blue;margin: 0;">Tejas Upankar</p>
        <p style="font-weight:300; margin: 0; border-bottom: 1px solid #000; padding-bottom: 5px;">Sr. Business Development Executive</p>
        <div>
            <img src="{{ asset('assets/images/image001.jpg') }}" style="max-width:100%; width: 350px;margin: 15px 0;" alt="">
        </div>
        <p style="font-weight:700;margin: 0;">Mobile:  +91 9665871799 / +91 8291912045 </p>
        <p style="font-weight:700;margin: 0;">Email: tejas.upankar@addonix.com</p>
        <p style="font-weight:700;margin: 0;">Website: www.addonix.com</p>
        <p style="font-weight:700;margin: 0;">Phone:   022 2927 4300</p>
        <br>
        <p style="font-weight:700;margin: 0;">Mumbai Office: 702/703, Vakratunda Corporate Park, Off, Aarey Rd, Vishweshwar Nagar, Goregaon (East), Mumbai 400063.</p>
        <p style="font-weight:700;margin: 0;">Thane Office: 102, Pratibha Building, Lal Bahadur Shastri Rd, near Tulasi Chambers, opp. Teen Petrol Pump, Thane (West) 400602.</p>
    </body>
</html>