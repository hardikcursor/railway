@extends('layouts.backend')

<style>
    .table-container {
        overflow-x: auto;
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    th,
    td {
        border: 1px solid #333;
        padding: 6px 8px;
        text-align: center;
        vertical-align: middle;
    }

    th {
        background: #184955;
        color: #fff;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: bold;
        display: inline-block;
        min-width: 120px;
        /* increase width so text fits */
        white-space: nowrap;
        /* prevent text from breaking into new line */
    }

    .strategic {
        background-color: #ffb980;
        /* orange */
        color: #7a3f00;
        /* darker text for contrast */
    }

    .routine {
        background-color: #ffe598;
        /* light yellow */
        color: #8a6d00;
        /* darker text for contrast */
    }

    .status {
        color: #fff;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: bold;
        display: inline-block;
        min-width: 90px;
    }

    .completed {
        background: #2e7d32;
    }

    .in-progress {
        background: #f9a825;
        color: #000;
    }

    .not-started {
        background: #c62828;
    }

    td:nth-child(2) {
        text-align: left;
    }

    /* Responsible Officer text pill */
    .resp-pill {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: bold;
        display: inline-block;
        min-width: 90px;
    }

    .resp-pm {
        background-color: #d9f5d9;
        /* light green */
        color: #52af58;
    }

    .resp-fm {
        background-color: #d9e8ff;
        /* light blue */
        color: #0d47a1;
    }

    .resp-dt {
        background-color: #d9f5d9;
        /* light green */
        color: #1b5e20;
    }

    /* Row background colors */
    .tr-default {
        background-color: #d3d3d3;
    }

    /* light gray */
    .tr-bfm {
        background-color: #d9f5d9;
    }

    /* light green */
    .tr-sstr {
        background-color: #fff9d9;
    }

    /* light yellow */

    /* Executing Officer text pill */
    .exec-pill {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: bold;
        display: inline-block;
        min-width: 90px;
        background-color: #b0b0b0;
        /* light gray */
        color: #000;
        /* text color */
    }
</style>

@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">

            <!-- DASHBOARD -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-success color-white ">
                        <div class="ibox-body">
                            <h2 class="font-strong">79</h2>
                            <div>Total Tasks</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-success color-white ">
                        <div class="ibox-body">
                            <h2 class="font-strong">49</h2>
                            <div>Not Started</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-info color-white">
                        <div class="ibox-body">
                            <h2 class="font-strong">27</h2>
                            <div>PENDING</div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-danger color-white ">
                        <div class="ibox-body">
                            <h2 class="font-strong">3</h2>
                            <div>COMPLETED</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-success">
                    <i class="ti-plus"></i> Create Task
                </button>
            </div> --}}


            <!-- TABLE -->
            <div class="ibox mt-4">
                <div class="ibox-head">
                    <div class="ibox-title">Task manager - All Record</div>
                </div>

                <div class="ibox-body table-wrapper-fixed">
                    <table>
                        <thead>
                            <tr>
                                <th>Task ID</th>
                                <th>Task Description</th>
                                <th>Category</th>
                                <th>Responsible Officer</th>
                                <th>Executing Officer</th>
                                <th>Target Date</th>
                                <th>Current Status</th>
                                <th>Remarks / Next Steps</th>
                            </tr>
                        </thead>

                        <tbody>

                            <!-- ================= A/PM TASKS ================= -->

                            <tr class="tr-default">
                                <td>A/PM-1</td>
                                <td>Preparation of Tender Document for Cleaning contract</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status completed">Completed</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-2</td>
                                <td>Preparation of Holding area, procurement of utility Items for Chath/Diwali Crowd
                                    Management at
                                    ADI Station</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/Coaching</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-3</td>
                                <td>Liaison with Headquarters for notification of TODs</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/Coaching</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-4</td>
                                <td>Disposal of K Padmaja Case, speaking order and reimbursement</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-5</td>
                                <td>Review of all Master Plans of all stations under development including provision of
                                    passenger
                                    amenities and commercial space</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-6</td>
                                <td>Re-organising CTI Squad and Posting of CTI Cadre</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-7</td>
                                <td>Verification of all pending partnership units and agreements</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-8</td>
                                <td>Review of all issues of catering units ie live certificates, court case, shifting of
                                    stall</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-9</td>
                                <td>Relocation of stalls back to pf no 8 ADI Station</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-10</td>
                                <td>Review of all parcel contract running as well as completed, verification of their BG, SD
                                    etc, and whether the SD/EMDs of completed contract are returned or not
                                </td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/Coaching</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-11</td>
                                <td>Reference to headquarter regarding ID cards to Catering Units</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-12</td>
                                <td>Finalisation of Standard QR code for Feedback for Toilets and Rate list of Catering
                                    Units</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-13</td>
                                <td>Procurement of ATVMs from other division to ADI division and deployment as planned</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/Coaching</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-14</td>
                                <td>Finalisation of ATVM Facilitators, and action plan for reaching Digital Transaction to
                                    50%</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/Coaching</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-15</td>
                                <td>Review of Ticket Checking Earning and TA ratio</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-16</td>
                                <td>Planning of weekly Fortress and Ambush check led by officer and increase in Squad and
                                    Sleeper
                                    staff Earning</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-17</td>
                                <td>Survey has to be done regarding condition of approach road to stations, wherever the
                                    road is poor,
                                    letter has to be written to state</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-18</td>
                                <td>Implementation of Swachhta Hi Sewa Campaign</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-19</td>
                                <td>Plan a meeting with all Parcel Customers and discuss about their grievances, and ways of
                                    increasing the Parcel loading and Earning</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/Coaching</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-20</td>
                                <td>Periodical Review of working of CTI Sleeper roaster and working of HTC staff</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-21</td>
                                <td>Review and report of working of Beetle App for cleanliness</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-22</td>
                                <td>Re-organising staff in complaint Cell, outsourcing like done by the mechanical</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-23</td>
                                <td>Review of all expenditure contracts, their PG/BG etc</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/Coaching</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-24</td>
                                <td>Review of working of porters at station and process of porter on call at stations where
                                    porter are
                                    not available</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-25</td>
                                <td>Process for cross functional and integrated cleaning contract, including CTS and
                                    watering</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-26</td>
                                <td>Status of extension of GNC-VRL to VDG</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/Coaching</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-default">
                                <td>A/PM-27</td>
                                <td>Joint of PF no 4&5 SBIB regarding available Toilets</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-pm">DCM/PM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <!-- ================= B/FM TASKS ================= -->

                            <tr class="tr-bfm">
                                <td>B/FM-1</td>
                                <td>Preparation of Holding area, procurement of utility Items for Chath/Diwali Crowd
                                    Management at
                                    SBIB</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status completed">Completed</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-2</td>
                                <td>Posting of CMIs, and revision of Duty list of office staff</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-3</td>
                                <td>Analysis of GST data as made available by Headquarters</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status completed">Completed</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-4</td>
                                <td>Procurement of Furniture for ABSS stations, including VIP room, Waiting area, Booking
                                    office,
                                    Parcel office etc specially for Asarva, Vatva, Maninagar</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-5</td>
                                <td>Renovation of seating arrangement in office for staff</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-6</td>
                                <td>Preparation of GAD of all Goodsheds</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-7</td>
                                <td>Preparation of planning of Commercial Exploitation of Newly Developed Stations</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-8</td>
                                <td>Action plan for improvement of infrastructure at all railway owned good sheds</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-9</td>
                                <td>Planning for trial of mechanized handling at good Shed preferably at KKF</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-10</td>
                                <td>Execution of Agreement regarding installation of EWIMB on Railway Land as approved by
                                    Headquarter</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-11</td>
                                <td>Expediting the process for Procurement of 100 PCs for staff</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-12</td>
                                <td>File of re-engagement be chased</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-13</td>
                                <td>Expediting the departmental CCTE exam with establishment</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill"> </span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <!-- ================= B/FM CONTINUED ================= -->

                            <tr class="tr-bfm">
                                <td>B/FM-14</td>
                                <td>Integration of Freight and Parcel Cell</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-15</td>
                                <td>Strengthening of CTI/Cell, IT Cell, Store Cell</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill"></span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-16</td>
                                <td>Creating a Special Team for field assignments</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill"></span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-17</td>
                                <td>Process for tenders of Advertisement hoardings and also find out new locations</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-18</td>
                                <td>Re-organising and strengthening the control working</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-19</td>
                                <td>Plan a meeting with all Advertisers and NFR Contractors and discuss about new ideas of
                                    increasing earning</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-20</td>
                                <td>Plan for a BDU meeting with all existing customers and industries manufacturing units
                                    cluster wise</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-21</td>
                                <td>Digitisation of office record and weeding out unnecessary items</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-22</td>
                                <td>Review of working of inspection module</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/Coaching</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-23</td>
                                <td>Review of all running NFR and other earning contracts, their SD, BG etc</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-24</td>
                                <td>Organise and meet new customers in field every fortnight, plan visit to industries and
                                    submit reports</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-25</td>
                                <td>Issuance of standard ID cards to the staff</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-26</td>
                                <td>Process file for development of Examination Facility at NCLW</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-27</td>
                                <td>Process for finalisation of GCT Agreement of Alpha Terminal, WC Terminal</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-28</td>
                                <td>Expedite the issues of SCLS, MHPL & CWCI</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-29</td>
                                <td>Process for procurement of laptops for cell incharge on replacement basis</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-30</td>
                                <td>Status of installation of EWIMB and completion of periodical officers inspection</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-31</td>
                                <td>Finalisation of GCT Agreement of Alpha Terminal, Chandisar</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status in-progress">In progress</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-32</td>
                                <td>Installation of CCTV in Goodshed, Parcel office, booking office, CTI Office</td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-bfm">
                                <td>B/FM-33</td>
                                <td>Planning of renovation of existing building of SBIB Station in line with new building
                                </td>
                                <td><span class="badge routine">Routine / Operational</span></td>
                                <td><span class="resp-pill resp-fm">DCM/FM</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <!-- ================= S/STR TASKS ================= -->

                            <tr class="tr-sstr">
                                <td>S/STR-1</td>
                                <td>Digital Station Initiative – 100% integration of QR-based feedback, e-auction,
                                    e-payment, e-pass issuance</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill">ACM/Coaching</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-2</td>
                                <td>Smart Passenger Amenities App – single app for feedback, porter-on-call, complaint
                                    registration, train inquiry</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-3</td>
                                <td>Dynamic Advertisement Policy – LED digital hoardings on platforms & concourses with
                                    centralized content</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-4</td>
                                <td>Premium Lounge / Executive Lounge at ADI & SBIB, MSH, KLMG, BNJ, BHUJ under NFR</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-5</td>
                                <td>Smart Parking Management – Access-controlled paid parking with ANPR</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-6</td>
                                <td>Dedicated Parcel Customer Portal for booking, tracking, payment</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill">ACM/Coaching</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-7</td>
                                <td>Parcel FM-LM trial with Rapido at Ahmedabad</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-8</td>
                                <td>Mini Logistics Parks near Goods Sheds – pilot at Asarva or KKF</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-9</td>
                                <td>Mechanised Loading Units – forklifts, conveyors at high-volume goods sheds</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-10</td>
                                <td>Station Retail Master Plan – structured development of shopping zones, food courts</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-11</td>
                                <td>Experiential Advertising – 3D walls, interactive kiosks</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-12</td>
                                <td>Smart Squad Deployment – GPS tracking, performance-linked incentives</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-13</td>
                                <td>Data Analytics for Ticket Checking – heatmap deployment in trains</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill">ACM/PM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-14</td>
                                <td>Skill Development & Soft Skills Training for CMIs, CTIs, Booking Staff (PPP with
                                    IIM-A/AMA)</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill"></span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-15</td>
                                <td>Commercial Innovation Cell – task force to ideate on revenue & services</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill"></span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-16</td>
                                <td>Weekly Customer Connect Day – DCM/ACMs meet parcel/customers/advertisers</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill"></span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-17</td>
                                <td>Plastic-Free Stations Drive – model eco-friendly stations</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill"></span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-18</td>
                                <td>Rainwater Harvesting at Goods Sheds & Stations</td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                            <tr class="tr-sstr">
                                <td>S/STR-19</td>
                                <td>Division Performance Dashboard (public display of daily, monthly, yearly performance)
                                </td>
                                <td><span class="badge strategic">Strategic / High Impact</span></td>
                                <td><span class="resp-pill resp-dt">Sr. DCM/Division Team</span></td>
                                <td><span class="exec-pill">ACM/FM</span></td>
                                <td></td>
                                <td><span class="status not-started">Not Started</span></td>
                                <td></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- JS -->
    <script>
        document.querySelectorAll('.custom-select-box').forEach(box => {
            const selected = box.querySelector('.custom-select-selected');
            const options = box.querySelector('.custom-select-options');

            selected.onclick = () => {
                options.style.display = options.style.display === 'block' ? 'none' : 'block';
            };

            options.querySelectorAll('.custom-option').forEach(opt => {
                opt.onclick = () => {
                    selected.innerHTML = opt.innerHTML;
                    options.style.display = 'none';
                };
            });
        });

        document.addEventListener('click', e => {
            document.querySelectorAll('.custom-select-options').forEach(opt => {
                if (!opt.parentElement.contains(e.target)) {
                    opt.style.display = 'none';
                }
            });
        });
    </script>

    <script>
        document.querySelectorAll('.showTextareaBtn').forEach(btn => {
            btn.addEventListener('click', function() {
                let form = this.closest('td').querySelector('.textareaForm');
                form.classList.toggle('d-none');
            });
        });
    </script>
@endsection
