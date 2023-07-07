<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Perform INVOICE</title>

	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

		* {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}

		body {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-size: 16px;
			font-family: 'Roboto', sans-serif;
		}

		page {
			background: white;
			display: block;
			margin: 0 auto;
			margin-bottom: 0.5cm;
		}

		page[size="A4"] {
			width: 21cm;
			height: 29.7cm;
			/*			padding: 0 15px;*/
			/*			border: 2px solid #000;*/
		}

		.text-center {
			text-align: center;
		}

		table {
			width: 100%;
		}

		table,
		td,
		th {
			border: 1px solid #595959;
			border-collapse: collapse;
			vertical-align: top;
			font-size: 14px;
		}

		td,
		th {
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

		p {
			margin-top: 0;
		}

		.bottomText {
			position: absolute;
			bottom: 15px;
			left: 50%;
			transform: translateX(-50%);
			width: 100%;
		}

		.backgroundImg {
			background: url('./http://dev.firsteconomy.com/emailerImages/adonnix/background-adonix.png') no-repeat;
			background-size: cover;
			height: 100%;
			background-position: center center;
		}

	</style>
</head>

<body>
	<page size="A4">
		<table>
			<tbody>
				<td>
					<img src="http://dev.firsteconomy.com/emailerImages/adonnix/firstimage.png" style="width: 100%;max-width: 100%" alt="">
				</td>
			</tbody>
		</table>
	</page>
	<page size="A4">
		<div class="backgroundImg" style="background: url(http://dev.firsteconomy.com/emailerImages/adonnix/background-adonix.png) no-repeat; background-size: cover; background-position: center center;">
			<div style="width: 85%; margin: 0 auto; position: relative; height: 100%; padding: 80px 0 0;">
				<h1 class="text-center fnt-1" style="margin-top: 30px;"><strong>About Us</strong></h1>

				<p>Addonix Technologies Pvt. Ltd. Is a leading IT solutions firm having its office in Mumbai, India and powered by a team of computer system professionals, delivering quality service to its clientele based in Mumbai, Thane &amp; Navi Mumbai.</p>
				<p>Since the formation of Addonix in 1996, it has diversified in field of Software business. We are a leading Value Added Reseller of Dassault Systemes SOLIDWORKS Corporation in Mumbai, India Since 1999. Addonix handles both commercial &amp; education business for SOLIDWORKS range of products. </p>
				<p> Addonix has a team of technically competent people who know how to effectively use the versatile capabilities of SOLIDWORKS. With our expertise in high end SOLIDWORKS 3D CAD we have helped our customers to achieve their desired goals sophistically.</p>
				<p>Our technical support team at Addonix is certified on the complete range of SOLIDWORKS products
					and supports close to 800+ Commercial clients with approx. 1800+ licenses at Mumbai and nearby
					regions as also 40+ Education clients having 13,000+ licenses being used there. Commercial verticals supported by Addonix include Machinery, Material Handling, Consumer, Power &amp; Process, Plastics and Electrical and Electronics amongst others.</p>
				<p>Addonix Technologies has also diversified into sales of Workstations and 3D Printers. We represent HP as their Reseller for Workstations and DBZ as their Reseller for 3D Printers.</p>
				<p><strong>Vision:-</strong></p>
				<p>Be India’s most customer centric company &amp; being a great place to work where people are inspired to be the best they can be to serve our customers.</p>
				<p><strong>Mission:-</strong></p>
				<p>Become a market leader by consistently exceeding our customer’s expectations; providing them with
					best of design technology solutions for Transforming Innovation into Business Success.</p>

				<div class="bottomText" style="position: absolute; bottom: 15px;left: 50%;transform: translateX(-50%);width: 100%;">
					<p style="font-size: 12px;text-align: center;font-weight: 700;">SOLIDWORKS 3D CAD | 3DEXPERIENCE WORKS | SOLIDWORKS Simulation| SOLIDWORKS PDM| SOLIDWORKS Visualize</p>
				</div>
			</div>
		</div>
	</page>

	<page size="A4">
		<div class="backgroundImg" style="background: url(http://dev.firsteconomy.com/emailerImages/adonnix/background-adonix.png) no-repeat; background-size: cover; background-position: center center;">
			<div style="width: 85%; margin: 0 auto; position: relative; height: 100%; padding: 80px 0 0;">
				<h1 class="text-center fnt-1" style="margin-top: 30px;"><strong>Proposal</strong></h1>

				<p>SOLIDWORKS provides the breadth of tools to tackle the most complex problems, and the depth
					to finish critical detail work in CAD. New features help you improve your product development
					process to get your innovative products into production faster.</p>

				<div class="tabelDiv" style="margin-bottom: 50px;">
					<h4 class="text-center fnt-1" style="margin-top: 30px;"><span style="text-decoration: underline"><strong>TECHNO-COMMERCIAL OFFER</strong></span></h4>

					<table>
						<tbody>
							<tr>
								<td><strong>Sr. No.</strong></td>
								<td style="text-align: center;width: 48%"><strong>Description</strong></td>
								<td style="text-align: center"><strong>Qty.</strong></td>
								<td style="text-align: center"><strong>Unit Price in INR</strong></td>
								<td style="text-align: center"><strong>Discount</strong></td>
								<td style="text-align: center"><strong>Total Price in INR</strong></td>
							</tr>
                            <?php 
                                $gst=0;
                                $productTotal=0;
                                $totalAmount=0;
                            ?>
                            @foreach($quotationData['product_id'] as $key => $value)
							<tr>
								<td style="text-align: center">01</td>
								<td>{{@$quotationData['product_id'][$key]}}</td>
								<td style="text-align: center">{{@$quotationData['quantity'][$key]}}</td>
								<td style="text-align: center">{{@$quotationData['price'][$key]}}</td>
								<td style="text-align: center">{{@$quotationData['discount'][$key]}}</td>
								<td style="text-align: center">{{number_format(@$quotationData['final_amount'][$key])}} /-</td>
							</tr>
                            <?php
                                if($quotationData['final_amount'][$key] != NUll || $quotationData['final_amount'][$key] == ''){
                                    $productTotal += @$quotationData['final_amount'][$key];
                                }
                            ?>
                            @endforeach
                            <?php
                                $gst = $productTotal * 18 / 100 ;
                                $totalAmount = $productTotal + $gst;
                            ?>
							<tr>
								<td style="text-align: right" colspan="5"><strong>Add: 18% GST</strong></td>
								<td style="text-align: center">{{number_format(@$gst)}}</td>
							</tr>
							<tr>
								<td style="text-align: right" colspan="5"><strong>Total</strong></td>
								<td style="text-align: center">{{number_format(@$totalAmount)}}</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="box" style="margin-bottom: 30px;">
					<p><strong>Note:-</strong></p>
					<ul>
						<li>Support for Software: - We are pleased to offer you installation, support on the software
							usability throughout the active subscription period.</li>
						<li>SolidWorks software, Software upgrades and updates to be downloaded from
							<a href="www.solidworks.com">www.solidworks.com</a> within the active subscription period.
						</li>
					</ul>
				</div>

				<div class="box" style="margin-bottom: 30px;">
					<p><strong>Hardware Requirement:-</strong></p>
					<ul>
						<li>SOLIDWORKS : <a href="www.solidworks.com">https://www.solidworks.com/support/system-requirements</a>
						</li>
					</ul>
				</div>

				<div class="bottomText" style="position: absolute; bottom: 15px;left: 50%;transform: translateX(-50%);width: 100%;">
					<p style="font-size: 12px;text-align: center;font-weight: 700;">SOLIDWORKS 3D CAD | 3DEXPERIENCE WORKS | SOLIDWORKS Simulation| SOLIDWORKS PDM| SOLIDWORKS Visualize</p>
				</div>
			</div>
		</div>
	</page>

	<page size="A4">
		<div class="backgroundImg" style="background: url(http://dev.firsteconomy.com/emailerImages/adonnix/background-adonix.png) no-repeat; background-size: cover; background-position: center center;">
			<div style="width: 85%; margin: 0 auto; position: relative; height: 100%; padding: 80px 0 0;">
				<h1 class="text-center fnt-1" style="margin-top: 30px;"><strong>Terms and Conditions</strong></h1>

				<p>SOLIDWORKS provides the breadth of tools to tackle the most complex problems, and the depth
					to finish critical detail work in CAD. New features help you improve your product development
					process to get your innovative products into production faster.</p>

				<div class="box" style="margin-bottom: 30px;">
					<ul style="list-style-type: auto;">
						<li style="margin-bottom: 15px;">This price is strictly confidential and should not be disclosed to any third party.</li>
						<li style="margin-bottom: 15px;">Installation: - Installation will be done free of cost.</li>
						<li style="margin-bottom: 15px;">Pricing, Payment terms: - <b>100% payment along with the purchase order.</b></li>
						<li style="margin-bottom: 15px;">Availability of necessary Hardware, Software, and requisite manpower, enabling the installation of the software and subsequent training of the software is in the scope of the customer. In case of delay in site preparation by customer leading to delay in installation and commissioning of the hardware/software/other items, the Subscription date will be as per order processing and entitlement date or starting date issued by DS SOLIDWORKS.</li>
						<li style="margin-bottom: 15px;"><b>Validity: - Quote valid till {{@$quotationData['validity']}}.</b></li>
						<li style="margin-bottom: 15px;"><b>Taxes: - CGST @ 9% and SGST @ 9% as applicable in addition to the price quoted.</b></li>
						<li style="margin-bottom: 15px;">Delivery: - Within 3 - 4 Weeks from the date of confirmed purchase order.</li>
						<li style="margin-bottom: 15px;">Hard copy manuals are available at extra cost. Please contact our sales team if required.</li>
						<li style="margin-bottom: 15px;">Order Cancellation: - Order once placed cannot be cancelled under any circumstances.</li>
					</ul>
				</div>

				<div class="bottomText" style="position: absolute; bottom: 15px;left: 50%;transform: translateX(-50%);width: 100%;">
					<p style="font-size: 12px;text-align: center;font-weight: 700;">SOLIDWORKS 3D CAD | 3DEXPERIENCE WORKS | SOLIDWORKS Simulation| SOLIDWORKS PDM| SOLIDWORKS Visualize</p>
				</div>
			</div>
		</div>
	</page>

	<page size="A4">
		<div class="backgroundImg" style="background: url(http://dev.firsteconomy.com/emailerImages/adonnix/background-adonix.png) no-repeat; background-size: cover; background-position: center center;">
			<div style="width: 85%; margin: 0 auto; position: relative; height: 100%; padding: 80px 0 0;">
				<h1 class="text-center fnt-1" style="margin-top: 30px;"><strong>Bank Details</strong></h1>

				<p>We look forward to work with your company to implement powerful software that will give you a
					competitive edge in your market.</p>

				<div class="box" style="margin-bottom: 30px;">
					<table>
						<tbody>
							<tr>
								<td>Please issue your Purchase Order and Cheque / DD in favour of:</td>
								<td><b>Addonix Technologies Pvt. Ltd.</b> <br>
									702/703, Vakratunda Corporate Park, <br>
									Vishweshwar Nagar, Off Aarey Road, Goregaon East <br>
									Mumbai - 400063 <br>
									P: +91 022-2927 4300</td>
							</tr>
							<tr>
								<td colspan="2">Please fax, email, or mail your purchase order to:</td>
							</tr>
							<tr>
								<td><b>Contact Name</b></td>
								<td>Mr. Mehul Vora/ Mr. Samir Panshikar</td>
							</tr>
							<tr>
								<td><b>Phone</b></td>
								<td>022- 2927 4300</td>
							</tr>
							<tr>
								<td><b>E-Mail</b></td>
								<td><a href="mailto:info@addonix.com">info@addonix.com</a></td>
							</tr>
							<tr>
								<td><b>PAN: </b>AABCA3885H</td>
								<td><b>Account Details:</b></td>
							</tr>
							<tr>
								<td><b>GST No.: </b>27AABCA3885H1ZK</td>
								<td><b>Bank: </b> HDFC BANKLTD</td>
							</tr>
							<tr>
								<td><b>HSC / SAC code: </b>998434</td>
								<td><b>Account No: </b>01142000009615</td>
							</tr>
							<tr>
								<td></td>
								<td><b>IFSC Code: </b>HDFC0001120</td>
							</tr>
							<tr>
								<td></td>
								<td><b>MICR Code: - </b>400240121</td>
							</tr>
						</tbody>
					</table>
				</div>

				<p>We look forward to work with your company to implement powerful software that will give you a
					competitive edge in your market.</p>

				<br>
				<br>
				<br>
				<br>

				<p>Thanking you.</p>
				<br>

				<p style="margin-bottom: 10px;">Yours sincerely,</p>
				<p style="margin-bottom: 5px;"><b>Vinaya Bendre</b></p>
				<p style="margin-bottom: 10px;">Deputy Manager- Marketing</p>
				<p style="margin-bottom: 10px;">702/703, Vakratunda Corporate Park |Off Aarey Road | Vishweshwar Nagar| Goregoan (East) | Mumbai 400 063</p>

				<p style="margin-bottom: 10px;">Phone: 91-22-2927 4300 | +91 9819299860 | Email: <a href="mailto:vinaya@addonix.com">vinaya@addonix.com</a></p>

				<p>Website: <a href="www.addonix.com">www.addonix.com</a></p>

				<div class="bottomText" style="position: absolute; bottom: 15px;left: 50%;transform: translateX(-50%);width: 100%;">
					<p style="font-size: 12px;text-align: center;font-weight: 700;">SOLIDWORKS 3D CAD | 3DEXPERIENCE WORKS | SOLIDWORKS Simulation| SOLIDWORKS PDM| SOLIDWORKS Visualize</p>
				</div>
			</div>
		</div>
	</page>
</body>

<script>
	function printDiv(divName) {
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
	}

</script>

</html>
