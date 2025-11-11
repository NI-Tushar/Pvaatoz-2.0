<!DOCTYPE html>
<html>

<head>
    <title>Assessment Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 14px;
            position: relative;
            text-align: justify;
        }

        /* Complete rewrite of header styling */
        .header {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            table-layout: fixed;
        }

        /* .logo, */
        .title,
        .company-details {
            display: table-cell;
            vertical-align: middle;
        }

        /* .logo {
            width: 25%;
        }

        .logo img {
            max-width: 100px;
            height: auto;
        } */

        .title {
            width: 50%;
            text-align: center;
        }

        .title h3 {
            font-size: 18px;
            margin: 0;
            color: #333;
        }

        .company-details {
            width: 25%;
            text-align: right;
            font-size: 10px;
            color: #555;
        }
        .company-details img{
            max-width: 100px;
            height: auto;
        }

        .company-details p {
            margin: 2px 0;
        }

        .divider {
            border-top: 1px solid #ddd;
            margin: 10px 0;
            clear: both;
        }

        /* Info section styling for side-by-side display */
        .info-section {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin-bottom: 20px;
            width: 100%;
            clear: both;
        }

        .student-info,
        .consultant-info {
            width: 45%;
            display: inline-block;
            vertical-align: top;
        }

        .student-info {
            float: left;
        }

        .consultant-info {
            float: right;
        }

        .student-info h5,
        .consultant-info h5 {
            color: #555;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .student-info ul,
        .consultant-info ul {
            list-style-type: none;
            padding: 0;
        }

        .student-info li,
        .consultant-info li {
            margin: 5px 0;
        }

        h5 {
            color: #555;
            margin-top: 20px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: auto;
            clear: both;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
            font-size: 10px;
            word-wrap: break-word;
            max-width: 100px;
        }

        th {
            background-color: #f2f2f2;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 5px 0;
        }

        .section {
            margin-bottom: 5px;
            page-break-inside: avoid;
            clear: both;
        }

        table {
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        /* Signature styling */
        .signature-container {
            width: 200px;
            margin-top: 20px;
        }

        .signature-container img {
            width: 100px;
            height: auto;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 100px;
            margin: 5px 0;
        }

        .signature-name {
            font-size: 10px;
            text-align: left;
            color: #333;
        }

        /* Last page signature wrapper */
        .last-page-signature {
            display: block;
            margin-top: 15mm;
            /* Ensure enough space to push it down */
            page-break-before: auto;
            /* Only break if needed */
        }

        @page {
            margin: 5mm;
            /* Standard margins */
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
            z-index: -1000;
        }

        /* Ensure content is above the watermark */
        body,
        table,
        .section {
            position: relative;
            z-index: 1;
        }

        /* Clear fix to handle floats */
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>

<body>
    <!-- Watermark -->
    <div class="watermark">
        <img src="{{ $watermarkPath }}" width="400" height="auto" alt="Watermark">
    </div>

    <!-- Header Section - Logo, Title, and Company Details on the same line -->
    <div class="header">
        {{-- <div class="logo">
            <img src="{{ $logoPath }}" alt="Logo">
        </div> --}}
        <div class="title">
            <h3>Assessment Report</h3>
        </div>
        <div class="company-details">
            <img src="{{ $logoPath }}" alt="Logo">
            <p>{{ $companyDetails['name'] }}</p>
            <p>{{ $companyDetails['address'] }}</p>
            <p>{{ 'Phone no.:' . $companyDetails['phonenumber']}}</p>
            <p>{{  'E-mail:' . $companyDetails['emailaddress'] }}</p>
        </div>
    </div>

    <!-- Divider -->
    <div class="divider"></div>

    <!-- Student and Consultant Info side by side -->
    <div class="info-section clearfix">
        <div class="student-info">
            <h5>Student Information</h5>
            <ul>
                <li><strong>Name:</strong> {{ $assessment->student->name ?? 'N/A' }}</li>
                <li><strong>Email:</strong> {{ $assessment->student->email ?? 'N/A' }}</li>
                <li><strong>Phone:</strong> {{ $assessment->student->phone ?? 'N/A' }}</li>
                <li><strong>Service Name:</strong> {{ $assessment->service_name ?? 'N/A' }}</li>
                <li><strong>Assessment Title:</strong> {{ $assessment->assessment_title ?? 'N/A' }}</li>
                <li><strong>Preferred Country:</strong> {{ $assessment->preferred_country ?? 'N/A' }}</li>
                <li><strong>Preferred Subject:</strong> {{ $assessment->preferred_subject ?? 'N/A' }}</li>
                <li><strong>Student Budget:</strong> BDT {{ number_format($assessment->student_budget, 2) ?? 'N/A' }}</li>
            </ul>
        </div>
        <div class="consultant-info">
            <h5>Consultant Information</h5>
            <ul>
                <li><strong>Name:</strong> {{ $assessment->consultant->name ?? 'N/A' }}</li>
                <li><strong>Email:</strong> {{ $assessment->consultant->email ?? 'N/A' }}</li>
                <li><strong>Phone:</strong> {{ $assessment->consultant->phone ?? 'N/A' }}</li>
                <li><strong>Assessment Charge:</strong>
                    BDT {{ number_format($assessment->assessment_charge, 2) ?? 'N/A' }}</li>
                <li><strong>Assessment Duration:</strong> {{ $assessment->assessment_duration ?? 'N/A' }}</li>
            </ul>
        </div>
    </div>

    <!-- Recommended Universities -->
    <div class="section">
        <h5>Recommended Universities</h5>
        @if ($universities->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>University</th>
                        <th>Course</th>
                        <th>Tuition Fees</th>
                        <th>Living Expenses</th>
                        <th>Total Budget</th>
                        <th>IELTS</th>
                        <th>Scholarships</th>
                        <th>Visa Type</th>
                        <th>Visa Processing Time</th>
                        <th>Application Processing Time</th>
                        <th>Admission Notification Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($universities as $university)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $university->university_name ?? 'N/A' }}</td>
                            <td>{{ $university->course_name ?? 'N/A' }}</td>
                            <td>BDT {{ number_format($university->tuition_fees, 2) }}</td>
                            <td>BDT {{ number_format($university->living_expenses, 2) }}</td>
                            <td>BDT {{ number_format($university->total_estimated_budget, 2) }}</td>
                            <td>{{ $university->ielts ?? 'N/A' }}</td>
                            <td>{{ $university->scholarships ?? 'N/A' }}</td>
                            <td>{{ $university->visa_type ?? 'N/A' }}</td>
                            <td>{{ $university->visa_processing_time ?? 'N/A' }}</td>
                            <td>{{ $university->application_processing_time ?? 'N/A' }}</td>
                            <td>{{ $university->admission_notification_time ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No universities added.</p>
        @endif
    </div>

    <!-- Language Proficiency & Requirements -->
    <div class="section">
        <h5>Language Proficiency & Requirements</h5>
        <ul>
            <li><strong>IELTS Score Required:</strong> {{ $otherAssessment->ielts_score ?? 'N/A' }}</li>
            <li><strong>Other Accepted Tests:</strong> {{ $otherAssessment->other_tests ?? 'N/A' }}</li>
            <li><strong>English Language Preparation:</strong> {{ $otherAssessment->english_prep ?? 'N/A' }}</li>
        </ul>
    </div>

    <!-- Health Insurance & Safety -->
    <div class="section">
        <h5>Health Insurance & Safety</h5>
        <ul>
            <li><strong>Health Insurance Required:</strong> {{ $otherAssessment->health_insurance ?? 'N/A' }}</li>
            <li><strong>Health Insurance Options:</strong> {{ $otherAssessment->insurance_options ?? 'N/A' }}</li>
            <li><strong>Additional Health Requirements:</strong> {{ $otherAssessment->additional_health ?? 'N/A' }}
            </li>
        </ul>
    </div>

    <!-- Visa & Immigration Process -->
    <div class="section">
        <h5>Visa & Immigration Process</h5>
        <ul>
            <li><strong>Visa Type:</strong> {{ $otherAssessment->visa_type ?? 'N/A' }}</li>
            <li><strong>Visa Application Requirements:</strong> {{ $otherAssessment->visa_requirements ?? 'N/A' }}</li>
            <li><strong>Visa Processing Time:</strong> {{ $otherAssessment->visa_processing ?? 'N/A' }}</li>
            <li><strong>Visa Interview Preparation:</strong> {{ $otherAssessment->visa_interview ?? 'N/A' }}</li>
        </ul>
    </div>

    <!-- Application & File Processing Time -->
    <div class="section">
        <h5>Application & File Processing Time</h5>
        <ul>
            <li><strong>University Application Processing Time:</strong>
                {{ $otherAssessment->university_processing ?? 'N/A' }}</li>
            <li><strong>Admission Notification Time:</strong> {{ $otherAssessment->admission_notification ?? 'N/A' }}
            </li>
            <li><strong>Visa Application Processing:</strong> {{ $otherAssessment->visa_application ?? 'N/A' }}</li>
            <li><strong>Final Confirmation & Visa Application:</strong>
                {{ $otherAssessment->final_confirmation ?? 'N/A' }}</li>
        </ul>
    </div>

    <!-- Next Steps / Checklist -->
    <div class="section">
        <h5>Next Steps / Checklist</h5>
        <ul>
            <li><strong>Step 1: Prepare for IELTS:</strong> {{ $otherAssessment->step_ielts ?? 'N/A' }}</li>
            <li><strong>Step 2: Collect Required Documents:</strong> {{ $otherAssessment->step_documents ?? 'N/A' }}
            </li>
            <li><strong>Step 3: Apply to Universities:</strong> {{ $otherAssessment->step_apply ?? 'N/A' }}</li>
            <li><strong>Step 4: Apply for Scholarships:</strong> {{ $otherAssessment->step_scholarships ?? 'N/A' }}
            </li>
            <li><strong>Step 5: Submit Visa Application:</strong> {{ $otherAssessment->step_visa ?? 'N/A' }}</li>
            <li><strong>Step 6: Prepare for Visa Interview:</strong> {{ $otherAssessment->step_interview ?? 'N/A' }}
            </li>
        </ul>
    </div>

    <!-- Additional Comments / Recommendations -->
    <div class="section">
        <h5>Additional Comments / Recommendations</h5>
        <p>{{ $otherAssessment->additional_comments ?? 'N/A' }}</p>
    </div>

    <!-- Signature on Last Page Only -->
    <div class="last-page-signature">
        <div class="signature-container">
            <img src="{{ $signaturepath }}" alt="Signature">
            <div class="signature-line"></div>
            <div class="signature-name">{{ $signerName }}</div>
        </div>
    </div>
</body>

</html>
