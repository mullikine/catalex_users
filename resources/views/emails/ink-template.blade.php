<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width"/>
		{{-- <link rel="stylesheet" href="/css/email.css"> For testing only --}}
	</head>
	<body>
		<table class="body">
			<tr>
			<td class="center" align="center" valign="top">
				<center>
					<table class="container header-large hide-for-small">
						<tr>
							<td>
								<table class="row">
									<tr>
										<td class="wrapper"><table class="nine columns"><tr><td></td></tr></table></td>
										<td class="wrapper title">
											<table class="two columns">
												<tr>
													<td class="center">
														{{ $title }}
													</td>
												</tr>
											</table>
										</td>
										<td class="wrapper last"><table class="one columns"><tr><td></td></tr></table></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table class="container header-small show-for-small">
						<tr>
							<td>
								<table class="row">
									<tr>
										<td class="wrapper last">
											<table class="twelve columns">
												<tr>
													<td>
														{!! Html::image('/images/email/header.png', 'Catalex') !!}
														<div class="hide-for-small title">{{ $title }}</div>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					@yield('content')
					<table class="container footer">
						<tr>
							<td>
								<table class="row">
									<tr>
										<td class="wrapper last">
											<table class="twelve columns">
												<tr>
													<td>
														<center>
															<p class="center">You are recieving this message because you have recently signed up with Catalex. If this was not you, please <a href="#">click here.</a></p>
															<p class="center">C/- Kanu Jeram Chartered Accountant Limited, 112 Kitchener Road, Milford, Auckland, 0620, New Zealand</p>
															<p class="center"><a href="#">UNSUBSCRIBE</a> &nbsp;|&nbsp; <a href="#">UPDATE SUBSCRIPTION PREFERENCES</a></p>
														</center>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</center>
			</td>
			</tr>
		</table>
	</body>
</html>