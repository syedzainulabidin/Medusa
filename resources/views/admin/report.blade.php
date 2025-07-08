<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report - Medusa Vaccination System</title>
    {{-- <link rel="stylesheet" href="{{ public_path('user/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ public_path('universal/style.css') }}">
</head>

<body>
    {{-- <div class="report-container"> --}}
    <center>
        <h1 style="color:var(--a);">MEDUSA</h1>
        <p>Vaccination System</p>
    </center>
    {{-- <div> --}}
    <div class="report_id"style="position: absolute;left:0"><strong>Report #</strong> {{ $report->id }}</div>
    <div class="dated" style="position: absolute;right:0"><strong>Dated #</strong> {{ $report->date }}</div>
    {{-- </div> --}}
    <center>
        <div style="color:var(--a);">
            <h1>Vaccination Report</h1>
            {{-- </center> --}}
        </div>
        <div class="content">
            <p style=text-align:justify;>
                This is to certify that <strong>{{ $report->child->name }}</strong>

                @if ($report->child->gender == 'male' or $report->child->gender == 'other')
                    S/o
                @else
                    D/o
                @endif

                <strong>{{ $report->parent->name }}</strong>, born on <em>{{ $report->child->dob }}</em>
                has been
                vaccinated with <strong>{{ $report->vaccine }}</strong> in
                accordance with the Medusa vaccination program. <strong>{{ $report->child->name }}</strong> was
                Vaccinated on
                <strong>{{ $report->date }}</strong> at
                <strong>{{ $report->hospital->name }}</strong>
                All standard procedures and safety protocols were followed during the administration of the vaccine. The
                recipient showed no adverse reaction at the time of vaccination and was advised to follow standard
                post-vaccination care instructions.
                This certificate is issued as an official record for personal, medical, or travel-related documentation,
                and confirms that <strong>{{ $report->child->name }}</strong> has complied with
                <strong>{{ $report->vaccine }}</strong> vaccine in
                accordance with the guidelines set by the
                relevant health authorities.
            </p>
        </div>
        <table align=start>
            <tr>
                <th>
                    <h2 style="color:var(--a);">Parent Details</h2>
                </th>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $report->parent->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $report->parent->email }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $report->parent->phone }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $report->parent->address }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <th>
                    <h2 style="color:var(--a);">Hospital Details</h2>
                </th>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $report->hospital->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $report->hospital->email }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $report->hospital->phone }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $report->hospital->address }}</td>
            </tr>
        </table>
        </div>
    </center>
    </div>
</body>

</html>
