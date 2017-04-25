@extends('emails.ink-template')

@section('content')
<table class="container main">
    <tr>
        <td>
            <table class="row">
                <tr>
                    <td class="wrapper last">
                        <table class="twelve columns">
                            <tr>
                                <td>
                                    <h2 class="center">Invitation to Access Good Companies </h2>
                                    <p>Hi {{ $name }},</p>
                                    <p>
                                        {{ $inviter }} has invited you to access the company records for {{ $company_name }}.
                                        <a href="{{ route('first-login.index', $token) }}">Click here</a> to accept the invitation and setup your account.
                                    </p>
                                    <p>Kind regards</p>
                                    <p>The CataLex team</p>
                                    <p><a href="mailto:mail@catalex.nz">mail@catalex.nz</a></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@endsection
