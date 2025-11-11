@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('breadcrumb', 'Report')
@section('previous-menu', 'Assessment Report')
@section('active-menu', 'Assessment Report')
@section('master-content')
    <style>
        /* Icon color styling */
        .accordion-button i,
        .btn i,
        .input-group-text i {
            color: var(--consultant-primary-color);
        }

        /* Icon container hover effects */
        .input-group-text {
            transition: all 0.3s ease;
            background-color: var(--consultant-color-transparent);
        }

        .input-group-text i {
            color: white;
        }

        .input-group-text:hover {
            background-color: var(--consultant-primary-color-hover);
        }

        .input-group-text:hover i {
            color: white;
        }

        /* Step number styling */
        .input-group-text:not([class*="fa-"]) {
            font-weight: bold;
            color: white;
            background-color: var(--consultant-primary-color);
        }

        .input-group-text:not([class*="fa-"]):hover {
            background-color: var(--consultant-primary-color-hover);
        }

        /* Accordion icon styling */
        .accordion-button:not(.collapsed) i {
            color: inherit;
        }

        /* Remove previous icon color rule */
        .btn-secondary i,
        .btn-success i {
            color: inherit !important;
        }

        /* Optional: Add hover state consistency */
        .btn-secondary:hover i,
        .btn-success:hover i {
            color: inherit !important;
        }

        /* Modal for full report */
        .modal-full-report {
            max-width: 95%;
            margin: 0.5rem auto;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .modal-content {
            border: none;
            padding: 0.5rem;
        }

        .modal-header {
            border-bottom: 1px solid #e9ecef;
            padding: 0.75rem 1rem;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .modal-body {
            font-size: 0.85rem;
            line-height: 1.4;
            padding: 1rem;
            max-height: 80vh;
            overflow-y: auto;
        }

        /* Timeline Navigation */
        .timeline-nav {
            position: fixed;
            /* top: 20px;
            left: 20px; */
            width: 250px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000; /* Ensure it stays above other content */
        }

        .timeline-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .timeline-nav li {
            margin-bottom: 15px;
            position: relative;
            padding-left: 40px;
        }

        .timeline-nav li a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .timeline-nav li a:hover,
        .timeline-nav li.active a {
            color: var(--consultant-primary-color);
        }

        .timeline-nav li::before {
            content: attr(data-step);
            position: absolute;
            left: 0;
            width: 30px;
            height: 30px;
            background: var(--consultant-primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .timeline-nav li.active::before {
            background: var(--consultant-primary-color-hover);
        }

        /* Progress Bar */
        .progress-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .progress-bar {
            height: 5px;
            background: var(--consultant-primary-color);
            width: 0;
            transition: width 0.3s ease;
        }

        /* Section Styling */
        .report-section {
            padding: 40px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            scroll-margin-top: 80px; /* Offset for fixed header */
        }

        .report-section h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--consultant-primary-color);
        }

        /* Main content margin to avoid overlap with fixed timeline */
        .main-content {
            margin-left: 290px; /* Width of timeline-nav (250px) + padding (20px + 20px) */
        }

        /* Responsive Table */
        .table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-compact {
            font-size: 0.8rem;
            width: 100%;
            min-width: 600px;
            margin-bottom: 0;
            border-collapse: collapse;
        }

        .table-compact th,
        .table-compact td {
            padding: 0.3rem 0.5rem;
            vertical-align: middle;
            white-space: nowrap;
        }

        .table-compact th {
            font-weight: 600;
            text-align: left;
        }

        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 0.75rem 1rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .timeline-nav {
                position: static;
                width: 100%;
                padding: 10px;
                overflow-x: auto;
                white-space: nowrap;
            }

            .timeline-nav ul {
                display: flex;
            }

            .timeline-nav li {
                display: inline-block;
                margin-right: 20px;
                padding-left: 0;
            }

            .timeline-nav li::before {
                display: none;
            }

            .timeline-nav li a {
                padding: 10px;
                background: #f1f1f1;
                border-radius: 4px;
            }

            .main-content {
                margin-left: 0; /* Remove margin on smaller screens */
            }
        }

        @media (max-width: 576px) {
            .modal-full-report {
                max-width: 100%;
                margin: 0;
            }

            .modal-body {
                font-size: 0.75rem;
                padding: 0.75rem;
            }

            .report-section h2 {
                font-size: 1.25rem;
            }

            .report-section {
                padding: 20px 10px;
            }

            .table-compact {
                font-size: 0.7rem;
            }

            .table-compact th,
            .table-compact td {
                padding: 0.2rem 0.4rem;
            }
        }
    </style>

    <div class="progress-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Timeline Navigation -->
            <div class="col-lg-3 col-md-4 d-none d-md-block">
                <div class="timeline-nav">
                    <ul>
                        <li data-step="1" class="active"><a href="#section-universities">Recommended Universities</a></li>
                        <li data-step="2"><a href="#section-language">Language Proficiency & Requirements</a></li>
                        <li data-step="3"><a href="#section-health">Health Insurance & Safety</a></li>
                        <li data-step="4"><a href="#section-visa">Visa & Immigration Process</a></li>
                        <li data-step="5"><a href="#section-processing">Application & File Processing Time</a></li>
                        <li data-step="6"><a href="#section-checklist">Next Steps / Checklist</a></li>
                        <li data-step="7"><a href="#section-comments">Additional Comments / Recommendations</a></li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9 col-md-8 main-content">
                @if (!$otherAssessment || $otherAssessment->submission_status !== 'Submitted')
                    <!-- Recommended Universities -->
                    <section id="section-universities" class="report-section">
                        <h2><i class="fas fa-university me-2"></i>Recommended Universities</h2>
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="fas fa-list me-2"></i>University List</h5>
                                <button class="btn btn-sm btn-outline-primary" onclick="showUniversityForm()">
                                    <i class="fas fa-plus me-1"></i> Add new
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="50px">#</th>
                                                <th>University</th>
                                                <th>Course</th>
                                                <th>Tuition Fees</th>
                                                <th>IELTS</th>
                                                <th width="100px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($universities as $university)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $university->university_name }}</td>
                                                    <td>{{ $university->course_name }}</td>
                                                    <td>${{ number_format($university->tuition_fees, 2) }}</td>
                                                    <td>{{ $university->ielts }}</td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <button
                                                                class="btn btn-sm btn-outline-primary p-1 edit-university"
                                                                data-university="{{ json_encode(array_merge($university->toArray(), ['id' => $university->id])) }}"
                                                                title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <form
                                                                action="{{ route('consultant.assessment.university.destroy', ['assessment' => $assessment, 'university' => $university]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-outline-danger p-1"
                                                                    title="Delete">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">No universities added yet</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- University Form -->
                        <div class="card mt-3 border-0 shadow-sm" id="universityForm" style="display: none;">
                            <div class="card-header bg-transparent">
                                <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i><span id="formTitle">Add University        University</span></h5>
                            </div>
                            <div class="card-body">
                                <form id="universityFormElement"
                                    action="{{ isset($universityToEdit) ? route('consultant.assessment.university.update', ['assessment' => $assessment, 'university' => $universityToEdit]) : route('consultant.assessment.university.store', $assessment) }}"
                                    method="POST" class="row g-3">
                                    @csrf
                                    @isset($universityToEdit)
                                        @method('PUT')
                                    @endisset
                                    <div class="col-md-6">
                                        <label class="form-label">University Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-school"></i></span>
                                            <input type="text" name="university_name" class="form-control"
                                                value="{{ $universityToEdit->university_name ?? '' }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Course Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                            <input type="text" name="course_name" class="form-control"
                                                value="{{ $universityToEdit->course_name ?? '' }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tuition Fees (Annual) in BDT</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                                            <input type="number" step="0.01" name="tuition_fees" class="form-control"
                                                value="{{ $universityToEdit->tuition_fees ?? '' }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Living Expenses (Annual) in BDT</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                                            <input type="number" step="0.01" name="living_expenses" class="form-control"
                                                value="{{ $universityToEdit->living_expenses ?? '' }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Total Estimated Budget in BDT</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calculator"></i></span>
                                            <input type="number" step="0.01" name="total_budget" class="form-control"
                                                value="{{ $universityToEdit->total_estimated_budget ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">IELTS</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-language"></i></span>
                                            <input type="number" name="ielts" class="form-control"
                                                value="{{ $universityToEdit->ielts ?? '' }}" min="0" max="9"
                                                step="0.5">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Scholarships</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-award"></i></span>
                                            <input type="text" name="scholarships" class="form-control"
                                                value="{{ $universityToEdit->scholarships ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Visa Type</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-passport"></i></span>
                                            <input type="text" name="visa_type" class="form-control"
                                                value="{{ $universityToEdit->visa_type ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Visa Processing Time</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            <input type="text" name="visa_processing_time" class="form-control"
                                                value="{{ $universityToEdit->visa_processing_time ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Application Processing Time</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-hourglass-half"></i></span>
                                            <input type="text" name="application_processing_time"
                                                class="form-control"
                                                value="{{ $universityToEdit->application_processing_time ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Admission Notification Time</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-bell"></i></span>
                                            <input type="text" name="admission_notification_time"
                                                class="form-control"
                                                value="{{ $universityToEdit->admission_notification_time ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="hideUniversityForm()">
                                            <i class="fas fa-times me-1"></i> Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> <span
                                                id="submitButtonText">{{ isset($universityToEdit) ? 'Update' : 'Save' }}
                                                University</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>

                    <!-- Language Proficiency & Requirements -->
                    <section id="section-language" class="report-section">
                        <h2><i class="fas fa-language me-2"></i>Language Proficiency & Requirements</h2>
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <form action="{{ route('consultant.report.update', $assessment) }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label">IELTS Score Required</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-star"></i></span>
                                                <input type="text" name="ielts_score" class="form-control"
                                                    value="{{ $otherAssessment->ielts_score ?? '' }}"
                                                    placeholder="e.g. 6.5 overall with no less than 6.0 in each component">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Other Accepted Tests</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                                <input type="text" name="other_tests" class="form-control"
                                                    value="{{ $otherAssessment->other_tests ?? '' }}"
                                                    placeholder="e.g. TOEFL, PTE, Duolingo">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">English Language Preparation</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-book"></i></span>
                                                <input type="text" name="english_prep" class="form-control"
                                                    value="{{ $otherAssessment->english_prep ?? '' }}"
                                                    placeholder="e.g. Pre-sessional English courses available">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                                            <button type="reset" class="btn btn-outline-secondary">
                                                <i class="fas fa-undo me-1"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>

                    <!-- Health Insurance & Safety -->
                    <section id="section-health" class="report-section">
                        <h2><i class="fas fa-heartbeat me-2"></i>Health Insurance & Safety</h2>
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <form action="{{ route('consultant.report.update', $assessment) }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Health Insurance Required</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-shield-alt"></i></span>
                                                <input type="text" name="health_insurance" class="form-control"
                                                    value="{{ $otherAssessment->health_insurance ?? '' }}"
                                                    placeholder="e.g. Mandatory for all international students">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Health Insurance Options</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-list-ul"></i></span>
                                                <input type="text" name="insurance_options" class="form-control"
                                                    value="{{ $otherAssessment->insurance_options ?? '' }}"
                                                    placeholder="e.g. University-provided or private insurance">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Additional Health Requirements</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-plus-circle"></i></span>
                                                <input type="text" name="additional_health" class="form-control"
                                                    value="{{ $otherAssessment->additional_health ?? '' }}"
                                                    placeholder="e.g. Vaccination requirements">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                                            <button type="reset" class="btn btn-outline-secondary">
                                                <i class="fas fa-undo me-1"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>

                    <!-- Visa & Immigration Process -->
                    <section id="section-visa" class="report-section">
                        <h2><i class="fas fa-passport me-2"></i>Visa & Immigration Process</h2>
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <form action="{{ route('consultant.report.update', $assessment) }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Visa Type</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                <input type="text" name="visa_type" class="form-control"
                                                    value="{{ $otherAssessment->visa_type ?? '' }}"
                                                    placeholder="e.g. Tier 4 (General) student visa">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Visa Application Requirements</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                                <input type="text" name="visa_requirements" class="form-control"
                                                    value="{{ $otherAssessment->visa_requirements ?? '' }}"
                                                    placeholder="e.g. CAS, financial evidence, TB test">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Visa Processing Time</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                <input type="text" name="visa_processing" class="form-control"
                                                    value="{{ $otherAssessment->visa_processing ?? '' }}"
                                                    placeholder="e.g. 3 weeks standard processing">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Visa Interview Preparation</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-comments"></i></span>
                                                <input type="text" name="visa_interview" class="form-control"
                                                    value="{{ $otherAssessment->visa_interview ?? '' }}"
                                                    placeholder="e.g. Common questions and tips">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                                            <button type="reset" class="btn btn-outline-secondary">
                                                <i class="fas fa-undo me-1"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>

                    <!-- Application & File Processing Time -->
                    <section id="section-processing" class="report-section">
                        <h2><i class="fas fa-hourglass-half me-2"></i>Application & File Processing Time</h2>
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <form action="{{ route('consultant.report.update', $assessment) }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label">University Application Processing Time</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-university"></i></span>
                                                <input type="text" name="university_processing" class="form-control"
                                                    value="{{ $otherAssessment->university_processing ?? '' }}"
                                                    placeholder="e.g. 4-6 weeks after submission">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Admission Notification Time</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                <input type="text" name="admission_notification" class="form-control"
                                                    value="{{ $otherAssessment->admission_notification ?? '' }}"
                                                    placeholder="e.g. Typically within 8 weeks">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Visa Application Processing</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-passport"></i></span>
                                                <input type="text" name="visa_application" class="form-control"
                                                    value="{{ $otherAssessment->visa_application ?? '' }}"
                                                    placeholder="e.g. 15 working days for standard">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Final Confirmation & Visa Application</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-check-double"></i></span>
                                                <input type="text" name="final_confirmation" class="form-control"
                                                    value="{{ $otherAssessment->final_confirmation ?? '' }}"
                                                    placeholder="e.g. After receiving unconditional offer">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                                            <button type="reset" class="btn btn-outline-secondary">
                                                <i class="fas fa-undo me-1"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>

                    <!-- Next Steps / Checklist -->
                    <section id="section-checklist" class="report-section">
                        <h2><i class="fas fa-tasks me-2"></i>Next Steps / Checklist</h2>
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <form action="{{ route('consultant.report.update', $assessment) }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Step 1: Prepare for IELTS</label>
                                            <div class="input-group">
                                                <span class="input-group-text">1</span>
                                                <input type="text" name="step_ielts" class="form-control"
                                                    value="{{ $otherAssessment->step_ielts ?? '' }}"
                                                    placeholder="e.g. Book test date, preparation materials">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Step 2: Collect Required Documents</label>
                                            <div class="input-group">
                                                <span class="input-group-text">2</span>
                                                <input type="text" name="step_documents" class="form-control"
                                                    value="{{ $otherAssessment->step_documents ?? '' }}"
                                                    placeholder="e.g. Transcripts, recommendation letters">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Step 3: Apply to Universities</label>
                                            <div class="input-group">
                                                <span class="input-group-text">3</span>
                                                <input type="text" name="step_apply" class="form-control"
                                                    value="{{ $otherAssessment->step_apply ?? '' }}"
                                                    placeholder="e.g. Submit applications before deadlines">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Step 4: Apply for Scholarships</label>
                                            <div class="input-group">
                                                <span class="input-group-text">4</span>
                                                <input type="text" name="step_scholarships" class="form-control"
                                                    value="{{ $otherAssessment->step_scholarships ?? '' }}"
                                                    placeholder="e.g. Check eligibility and deadlines">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Step 5: Submit Visa Application</label>
                                            <div class="input-group">
                                                <span class="input-group-text">5</span>
                                                <input type="text" name="step_visa" class="form-control"
                                                    value="{{ $otherAssessment->step_visa ?? '' }}"
                                                    placeholder="e.g. After receiving offer letter">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Step 6: Prepare for Visa Interview</label>
                                            <div class="input-group">
                                                <span class="input-group-text">6</span>
                                                <input type="text" name="step_interview" class="form-control"
                                                    value="{{ $otherAssessment->step_interview ?? '' }}"
                                                    placeholder="e.g. Practice common questions">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                                            <button type="reset" class="btn btn-outline-secondary">
                                                <i class="fas fa-undo me-1"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>

                    <!-- Additional Comments / Recommendations -->
                    <section id="section-comments" class="report-section">
                        <h2><i class="fas fa-comment-dots me-2"></i>Additional Comments / Recommendations</h2>
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <form action="{{ route('consultant.report.update', $assessment) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label">Additional Comments</label>
                                            <textarea name="additional_comments" class="form-control" rows="5"
                                                placeholder="Enter any additional recommendations or comments for the student...">{{ $otherAssessment->additional_comments ?? '' }}</textarea>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                                            <button type="reset" class="btn btn-outline-secondary">
                                                <i class="fas fa-undo me-1"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                @endif

                <!-- Action Buttons -->
                <div class="mt-4 d-flex justify-content-end gap-2">
                    @if ($otherAssessment && $otherAssessment->submission_status === 'Submitted')
                        <button type="button" class="btn btn-secondary btn-lg" data-bs-toggle="modal"
                            data-bs-target="#fullReportModal">
                            <i class="fas fa-eye me-2"></i> View Full Report
                        </button>
                    @else
                        <button type="button" class="btn btn-secondary btn-lg" data-bs-toggle="modal"
                            data-bs-target="#fullReportModal">
                            <i class="fas fa-eye me-2"></i> View Full Report
                        </button>
                        <form action="{{ route('consultant.report.submit', $assessment) }}" method="POST"
                            id="submitReportForm">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg" id="sendToStudentBtn">
                                <i class="fas fa-file-pdf me-2"></i> Send to Student
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Full Report Modal -->
    <div class="modal fade" id="fullReportModal" tabindex="-1" aria-labelledby="fullReportModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-full-report modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fullReportModalLabel">Full Assessment Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Recommended Universities -->
                    <div class="report-section">
                        <h5>Recommended Universities</h5>
                        @if ($universities->isNotEmpty())
                            <div class="table-container">
                                <table class="table table-compact">
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
                                            <th>Visa Processing</th>
                                            <th>App. Processing</th>
                                            <th>Admission Notification</th>
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
                            </div>
                        @else
                            <p>No universities added yet.</p>
                        @endif
                    </div>

                    <!-- Language Proficiency & Requirements -->
                    <div class="report-section">
                        <h5>Language Proficiency & Requirements</h5>
                        <ul>
                            <li><strong>IELTS Score Required:</strong> {{ $otherAssessment->ielts_score ?? 'N/A' }}</li>
                            <li><strong>Other Accepted Tests:</strong> {{ $otherAssessment->other_tests ?? 'N/A' }}</li>
                            <li><strong>English Language Preparation:</strong>
                                {{ $otherAssessment->english_prep ?? 'N/A' }}</li>
                        </ul>
                    </div>

                    <!-- Health Insurance & Safety -->
                    <div class="report-section">
                        <h5>Health Insurance & Safety</h5>
                        <ul>
                            <li><strong>Health Insurance Required:</strong>
                                {{ $otherAssessment->health_insurance ?? 'N/A' }}</li>
                            <li><strong>Health Insurance Options:</strong>
                                {{ $otherAssessment->insurance_options ?? 'N/A' }}</li>
                            <li><strong>Additional Health Requirements:</strong>
                                {{ $otherAssessment->additional_health ?? 'N/A' }}</li>
                        </ul>
                    </div>

                    <!-- Visa & Immigration Process -->
                    <div class="report-section">
                        <h5>Visa & Immigration Process</h5>
                        <ul>
                            <li><strong>Visa Type:</strong> {{ $otherAssessment->visa_type ?? 'N/A' }}</li>
                            <li><strong>Visa Application Requirements:</strong>
                                {{ $otherAssessment->visa_requirements ?? 'N/A' }}</li>
                            <li><strong>Visa Processing Time:</strong> {{ $otherAssessment->visa_processing ?? 'N/A' }}
                            </li>
                            <li><strong>Visa Interview Preparation:</strong>
                                {{ $otherAssessment->visa_interview ?? 'N/A' }}</li>
                        </ul>
                    </div>

                    <!-- Application & File Processing Time -->
                    <div class="report-section">
                        <h5>Application & File Processing Time</h5>
                        <ul>
                            <li><strong>University Application Processing Time:</strong>
                                {{ $otherAssessment->university_processing ?? 'N/A' }}</li>
                            <li><strong>Admission Notification Time:</strong>
                                {{ $otherAssessment->admission_notification ?? 'N/A' }}</li>
                            <li><strong>Visa Application Processing:</strong>
                                {{ $otherAssessment->visa_application ?? 'N/A' }}</li>
                            <li><strong>Final Confirmation & Visa Application:</strong>
                                {{ $otherAssessment->final_confirmation ?? 'N/A' }}</li>
                        </ul>
                    </div>

                    <!-- Next Steps / Checklist -->
                    <div class="report-section">
                        <h5>Next Steps / Checklist</h5>
                        <ul>
                            <li><strong>Step 1: Prepare for IELTS:</strong> {{ $otherAssessment->step_ielts ?? 'N/A' }}
                            </li>
                            <li><strong>Step 2: Collect Required Documents:</strong>
                                {{ $otherAssessment->step_documents ?? 'N/A' }}</li>
                            <li><strong>Step 3: Apply to Universities:</strong> {{ $otherAssessment->step_apply ?? 'N/A' }}
                            </li>
                            <li><strong>Step 4: Apply for Scholarships:</strong>
                                {{ $otherAssessment->step_scholarships ?? 'N/A' }}</li>
                            <li><strong>Step 5: Submit Visa Application:</strong>
                                {{ $otherAssessment->step_visa ?? 'N/A' }}</li>
                            <li><strong>Step 6: Prepare for Visa Interview:</strong>
                                {{ $otherAssessment->step_interview ?? 'N/A' }}</li>
                        </ul>
                    </div>

                    <!-- Additional Comments / Recommendations -->
                    <div class="report-section">
                        <h5>Additional Comments / Recommendations</h5>
                        <p>{{ $otherAssessment->additional_comments ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

    <script>
        // Smooth scrolling for timeline navigation
        document.querySelectorAll('.timeline-nav a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                targetElement.scrollIntoView({ behavior: 'smooth' });

                // Update active state
                document.querySelectorAll('.timeline-nav li').forEach(li => li.classList.remove('active'));
                this.parentElement.classList.add('active');
            });
        });

        // Progress bar and active section tracking
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('.report-section');
            const timelineItems = document.querySelectorAll('.timeline-nav li');
            const progressBar = document.getElementById('progressBar');
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;

            // Update progress bar
            progressBar.style.width = scrollPercent + '%';

            // Highlight active section in timeline
            let currentSection = null;
            sections.forEach((section, index) => {
                const sectionTop = section.offsetTop - 100; // Offset for header
                if (scrollTop >= sectionTop) {
                    currentSection = index;
                }
            });

            if (currentSection !== null) {
                timelineItems.forEach(li => li.classList.remove('active'));
                timelineItems[currentSection].classList.add('active');
            }
        });

        // University Name validation
        const universityNameField = document.querySelector('input[name="university_name"]');
        const form = document.getElementById('universityFormElement');

        if (universityNameField) {
            universityNameField.addEventListener('input', function() {
                const value = this.value.trim();
                if (/^\d+$/.test(value)) {
                    this.value = '';
                    Swal.fire({
                        icon: 'warning',
                        title: 'Invalid enter code hereInput',
                        text: 'University name cannot be a number.',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }
            });

            form.addEventListener('submit', function(e) {
                const universityNameValue = universityNameField.value.trim();
                if (/^\d+$/.test(universityNameValue)) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid University Name',
                        text: 'University name cannot be a number.',
                        confirmButtonText: 'OK',
                    });
                }
            });
        }

        // IELTS input validation
        document.addEventListener('DOMContentLoaded', function() {
            const ieltsField = document.querySelector('input[name="ielts"]');
            if (ieltsField) {
                ieltsField.addEventListener('input', function() {
                    const value = parseFloat(this.value);
                    if (value > 9) {
                        this.value = 9;
                        Swal.fire({
                            icon: 'warning',
                            title: 'Invalid Input',
                            text: 'IELTS score cannot be greater than 9.',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                });

                form.addEventListener('submit', function(e) {
                    const ieltsValue = parseFloat(ieltsField.value);
                    if (ieltsValue > 9) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid IELTS Score',
                            text: 'IELTS score must not exceed 9.',
                            confirmButtonText: 'OK',
                        });
                    }
                });
            }
        });

        function showUniversityForm(university = null) {
            const form = document.getElementById('universityForm');
            const formElement = document.getElementById('universityFormElement');
            const formTitle = document.getElementById('formTitle');
            const submitButtonText = document.getElementById('submitButtonText');

            let methodInput = formElement.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                formElement.appendChild(methodInput);
            }

            if (university) {
                if (typeof university === 'string') {
                    university = JSON.parse(university);
                }

                formTitle.textContent = 'Edit University';
                submitButtonText.textContent = 'Update University';
                methodInput.value = 'PUT';

                const updateRoute =
                    "{{ route('consultant.assessment.university.update', ['assessment' => $assessment, 'university' => ':id']) }}";
                formElement.action = updateRoute.replace(':id', university.id);

                const tuitionFees = parseFloat(university.tuition_fees) || 0;
                const livingExpenses = parseFloat(university.living_expenses) || 0;
                university.total_estimated_budget = tuitionFees + livingExpenses;

                Object.keys(university).forEach(key => {
                    const input = formElement.querySelector(`[name="${key}"]`);
                    if (input) {
                        input.value = university[key] || '';
                    }
                });
            } else {
                formTitle.textContent = 'Add University';
                submitButtonText.textContent = 'Save University';
                methodInput.value = 'POST';
                formElement.action = "{{ route('consultant.assessment.university.store', $assessment) }}";
                formElement.reset();

                const totalBudgetField = formElement.querySelector('[name="total_budget"]');
                if (totalBudgetField) {
                    totalBudgetField.value = '';
                }
            }

            form.style.display = 'block';
            form.scrollIntoView({ behavior: 'smooth' });
        }

        function hideUniversityForm() {
            document.getElementById('universityForm').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('universityFormElement');
            if (form) {
                const tuitionField = form.querySelector('[name="tuition_fees"]');
                const livingField = form.querySelector('[name="living_expenses"]');
                const totalField = form.querySelector('[name="total_budget"]');

                if (tuitionField && livingField && totalField) {
                    const calculateTotal = () => {
                        const tuition = parseFloat(tuitionField.value) || 0;
                        const living = parseFloat(livingField.value) || 0;
                        totalField.value = (tuition + living).toFixed(2);
                    };

                    tuitionField.addEventListener('input', calculateTotal);
                    livingField.addEventListener('input', calculateTotal);
                }
            }

            document.querySelectorAll('.edit-university').forEach(button => {
                button.addEventListener('click', function() {
                    const university = this.getAttribute('data-university');
                    showUniversityForm(university);
                });
            });

            if (form) {
                const tuitionField = form.querySelector('[name="tuition_fees"]');
                const livingField = form.querySelector('[name="living_expenses"]');
                if (tuitionField && livingField && tuitionField.value && livingField.value) {
                    const totalField = form.querySelector('[name="total_budget"]');
                    if (totalField) {
                        const tuition = parseFloat(tuitionField.value) || 0;
                        const living = parseFloat(livingField.value) || 0;
                        totalField.value = (tuition + living).toFixed(2);
                    }
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('form[action*="university"]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    const isDeleteForm = this.querySelector('input[name="_method"][value="DELETE"]') !== null;

                    if (isDeleteForm) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: 'Deleting...',
                                    text: 'Please wait while we delete the university',
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                                this.submit();
                            }
                        });
                    }
                });
            });
        });

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 1000,
                showConfirmButton: false,
            });
        @endif

        document.addEventListener('DOMContentLoaded', function() {
            const sendBtn = document.getElementById('sendToStudentBtn');
            if (sendBtn) {
                sendBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Once sent, you won't be able to make changes to this report anymore!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#CD5C00',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, send it!',
                        cancelButtonText: 'Cancel',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Sending...',
                                text: 'Please wait while we process your request',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                            document.getElementById('submitReportForm').submit();
                        }
                    });
                });
            }
        });
    </script>
@endpush
