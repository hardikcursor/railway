@extends('layouts.backend')

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background: #fff;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 6px 6px;
        text-align: center;
        vertical-align: middle;
    }

    /* Top Date */
    .report-date {
        background: #b7d7f0;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
    }

    /* Group Header */
    .group-head {
        background: #d9ecf7;
        font-weight: bold;
        text-align: center;
        font-size: 15px;
    }

    /* Column Header */
    .col-head {
        background: #f6caca;
        font-weight: bold;
    }

    /* Amount / Total shading */
    .amt-bg {
        background: #e6e6e6;
    }

    /* Left align text */
    .text-left {
        text-align: left;
    }

    /* Total Row */
    .total-row th {
        font-weight: bold;
        background: #f0f0f0;
    }
</style>

@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">

            <!-- DASHBOARD -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="ibox bg-success color-white ">
                        <div class="ibox-body">
                            <h2 class="font-strong">12</h2>
                            <div>Non stated</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="ibox bg-info color-white">
                        <div class="ibox-body">
                            <h2 class="font-strong">8</h2>
                            <div>PENDING</div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-md-6">
                    <div class="ibox bg-danger color-white ">
                        <div class="ibox-body">
                            <h2 class="font-strong">3</h2>
                            <div>COMPLETED</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-success">
                    <i class="ti-plus"></i> Create Task
                </button>
            </div>


            <!-- TABLE -->
            <div class="ibox mt-4">
                <div class="ibox-head">
                    <div class="ibox-title">All Record</div>
                </div>

                <div class="ibox-body table-wrapper-fixed">

                    <table>

                        <!-- Date -->
                        <tr>
                            <th colspan="14" class="report-date">01/04/25</th>
                        </tr>

                        <!-- GROUP I -->
                        <tr>
                            <th colspan="14" class="group-head">Group I</th>
                        </tr>

                        <!-- Header Row -->
                        <tr class="col-head">
                            <th rowspan="2">Sr No</th>
                            <th rowspan="2">Name of Staff</th>
                            <th rowspan="2">Desg</th>
                            <th rowspan="2">Mobile No.</th>
                            <th colspan="2">WT</th>
                            <th colspan="2">OT / HT</th>
                            <th colspan="2">UBL</th>
                            <th colspan="2">Total</th>
                            <th rowspan="2">Trains worked by each group</th>
                        </tr>

                        <tr class="col-head">
                            <th>Cases</th>
                            <th>Amt</th>
                            <th>Cases</th>
                            <th>Amt</th>
                            <th>Cases</th>
                            <th>Amt</th>
                            <th>Cases</th>
                            <th>Amt</th>
                        </tr>

                        <!-- DATA ROWS -->
                        <tr>
                            <td>1</td>
                            <td class="text-left">Amrish Sharma</td>
                            <td>CTI & IC</td>
                            <td>7043784481</td>
                            <td>8</td>
                            <td class="amt-bg">8780</td>
                            <td>12</td>
                            <td class="amt-bg">6530</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>20</td>
                            <td class="amt-bg">15310</td>
                            <td class="amt-bg">12947 / 19483 / 11092</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td class="text-left">Harvendra Singh</td>
                            <td>Sr TE</td>
                            <td>8460439181</td>
                            <td>1</td>
                            <td class="amt-bg">850</td>
                            <td>39</td>
                            <td class="amt-bg">17250</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>40</td>
                            <td class="amt-bg">18100</td>
                            <td>11463 / 19015</td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td class="text-left">Bittal Patel</td>
                            <td>Sr TE</td>
                            <td>8141802555</td>
                            <td>4</td>
                            <td class="amt-bg">4400</td>
                            <td>15</td>
                            <td class="amt-bg">7650</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>19</td>
                            <td class="amt-bg">12050</td>
                            <td>19167 / 12833</td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td class="text-left">Nehal K</td>
                            <td>Sr TE</td>
                            <td>7283920243</td>
                            <td>5</td>
                            <td class="amt-bg">5500</td>
                            <td>16</td>
                            <td class="amt-bg">7230</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>21</td>
                            <td class="amt-bg">12730</td>
                            <td>19167 / 12833</td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td class="text-left">Hemlata Chauhan</td>
                            <td>Sr TE</td>
                            <td>9374937494</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>Rest</td>
                        </tr>

                        <tr>
                            <td>6</td>
                            <td class="text-left">Rajkumar S</td>
                            <td>Sr TE</td>
                            <td>8003149081</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>Rest</td>
                        </tr>

                        <tr>
                            <td>7</td>
                            <td class="text-left">R A Rajpurohit</td>
                            <td>Dy CTI</td>
                            <td>9071315213</td>
                            <td>8</td>
                            <td class="amt-bg">7700</td>
                            <td>16</td>
                            <td class="amt-bg">7900</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>24</td>
                            <td class="amt-bg">15600</td>
                            <td>19489 / 22959</td>
                        </tr>

                        <!-- GROUP I TOTAL -->
                        <tr class="total-row">
                            <th colspan="4">Group I Total</th>
                            <th>26</th>
                            <th>27230</th>
                            <th>98</th>
                            <th>46560</th>
                            <th>0</th>
                            <th>0</th>
                            <th>124</th>
                            <th>73790</th>
                            <th></th>
                        </tr>

                        <!-- GROUP II -->
                        <tr>
                            <th colspan="14" class="group-head">Group II</th>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td class="text-left">Vinod M Vania</td>
                            <td>CTI & IC</td>
                            <td>9824643158</td>
                            <td>7</td>
                            <td class="amt-bg">7010</td>
                            <td>10</td>
                            <td class="amt-bg">5050</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>17</td>
                            <td class="amt-bg">12060</td>
                            <td>20968 / 22959</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td class="text-left">Bharti Vani</td>
                            <td>SR.TE</td>
                            <td>9427072611</td>
                            <td>5</td>
                            <td class="amt-bg">5000</td>
                            <td>3</td>
                            <td class="amt-bg">1500</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>8</td>
                            <td class="amt-bg">6500</td>
                            <td>20939 / 12547</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td class="text-left">Santosh Kumari</td>
                            <td>Dy CTI</td>
                            <td>9662936173</td>
                            <td>8</td>
                            <td class="amt-bg">8000</td>
                            <td>20</td>
                            <td class="amt-bg">9500</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>28</td>
                            <td class="amt-bg">17500</td>
                            <td class="amt-bg">20939 / 22548 / 20485</td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td class="text-left">Lalita Tiwari</td>
                            <td>Dy CTI</td>
                            <td>7043784293</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>Rest</td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td class="text-left">Niraj Mehta</td>
                            <td>Dy CTI</td>
                            <td>7043784372</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>15</td>
                            <td class="amt-bg">7190</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>15</td>
                            <td class="amt-bg">7190</td>
                            <td>20939 / 12547</td>
                        </tr>

                        <tr>
                            <td>6</td>
                            <td class="text-left">Sanjay Bar</td>
                            <td>Dy CTI</td>
                            <td>7043784196</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>Rest</td>
                        </tr>

                        <tr>
                            <td>7</td>
                            <td class="text-left">Zala Pruthvi</td>
                            <td>Sr TE</td>
                            <td>7487872277</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>Rest</td>
                        </tr>


                        <tr class="total-row">
                            <th colspan="4">Group II Total</th>
                            <th>20</th>
                            <th>20010</th>
                            <th>48</th>
                            <th>23240</th>
                            <th>0</th>
                            <th>0</th>
                            <th>68</th>
                            <th>43250</th>
                            <th></th>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td class="text-left">S M Vyas</td>
                            <td>CTI & IC</td>
                            <td>7043784476</td>
                            <td>4</td>
                            <td class="amt-bg">3800</td>
                            <td>21</td>
                            <td class="amt-bg">10200</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>25</td>
                            <td class="amt-bg">14000</td>
                            <td>19489 / 22959 / 11463</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td class="text-left">N B Parmar</td>
                            <td>CTI</td>
                            <td>7043784490</td>
                            <td>10</td>
                            <td class="amt-bg">9600</td>
                            <td>5</td>
                            <td class="amt-bg">2500</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>15</td>
                            <td class="amt-bg">12100</td>
                            <td>20939 / 20485</td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td class="text-left">Vijay Dutt</td>
                            <td>SR. TE</td>
                            <td>9321995606</td>
                            <td>3</td>
                            <td class="amt-bg">3250</td>
                            <td>16</td>
                            <td class="amt-bg">8110</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>19</td>
                            <td class="amt-bg">11360</td>
                            <td>19483 / 22945 / 19489 / 19484</td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td class="text-left">Surendra Chaudhry</td>
                            <td>TE</td>
                            <td>8487822187</td>
                            <td>5</td>
                            <td class="amt-bg">3120</td>
                            <td>24</td>
                            <td class="amt-bg">10440</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>29</td>
                            <td class="amt-bg">13560</td>
                            <td>20939 / 22548 / 12915</td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td class="text-left">Sharavan K</td>
                            <td>TE</td>
                            <td>9950658454</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>Rest</td>
                        </tr>

                        <tr>
                            <td>6</td>
                            <td class="text-left">Dilkhush Meena</td>
                            <td>TE</td>
                            <td>9672171864</td>
                            <td>10</td>
                            <td class="amt-bg">8000</td>
                            <td>8</td>
                            <td class="amt-bg">3970</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>18</td>
                            <td class="amt-bg">11970</td>
                            <td>19489 / 19484</td>
                        </tr>

                        <tr>
                            <td>7</td>
                            <td class="text-left">Shail Tiwari</td>
                            <td>Dy CTI</td>
                            <td>8000680224</td>
                            <td>11</td>
                            <td class="amt-bg">9860</td>
                            <td>10</td>
                            <td class="amt-bg">4890</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>21</td>
                            <td class="amt-bg">14750</td>
                            <td>12947 / 19167 / 12833</td>
                        </tr>

                        <tr class="total-row">
                            <th colspan="4">Group III Total</th>
                            <th>43</th>
                            <th>37630</th>
                            <th>84</th>
                            <th>40110</th>
                            <th>0</th>
                            <th>0</th>
                            <th>127</th>
                            <th>77740</th>
                            <th></th>
                        </tr>

                        <tr>
                            <th colspan="14" class="group-head">Group IV</th>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td class="text-left">Saji Philip</td>
                            <td>CTI & IC</td>
                            <td>7043784372</td>
                            <td>6</td>
                            <td class="amt-bg">6340</td>
                            <td>13</td>
                            <td class="amt-bg">6640</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>19</td>
                            <td class="amt-bg">12980</td>
                            <td>19167 / 12833</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td class="text-left">Jai Gopal</td>
                            <td>Dy CTI</td>
                            <td>7817066307</td>
                            <td>4</td>
                            <td class="amt-bg">4000</td>
                            <td>17</td>
                            <td class="amt-bg">8620</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>21</td>
                            <td class="amt-bg">12620</td>
                            <td>12833 / 19489</td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td class="text-left">Himanshu J</td>
                            <td>TE</td>
                            <td>7339957420</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>Rest</td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td class="text-left">Ramavdesh</td>
                            <td>Sr CCTC</td>
                            <td>7903124938</td>
                            <td>4</td>
                            <td class="amt-bg">3650</td>
                            <td>14</td>
                            <td class="amt-bg">6450</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>18</td>
                            <td class="amt-bg">10100</td>
                            <td>20939 / 12915</td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td class="text-left">Shailesh Shrimali</td>
                            <td>Dy CTI</td>
                            <td>9427805657</td>
                            <td>5</td>
                            <td class="amt-bg">5340</td>
                            <td>9</td>
                            <td class="amt-bg">4740</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>14</td>
                            <td class="amt-bg">10080</td>
                            <td>12947 / 19167 / 12833</td>
                        </tr>

                        <tr>
                            <td>6</td>
                            <td class="text-left">Navneet R</td>
                            <td>Dy CTI</td>
                            <td>7043784202</td>
                            <td>11</td>
                            <td class="amt-bg">10700</td>
                            <td>10</td>
                            <td class="amt-bg">5010</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>21</td>
                            <td class="amt-bg">15710</td>
                            <td>12947 / 19167 / 19489</td>
                        </tr>

                        <tr>
                            <td>7</td>
                            <td class="text-left">Y C Gurjar</td>
                            <td>Dy CTI</td>
                            <td>7043784334</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>Rest</td>
                        </tr>

                        <tr>
                            <td>8</td>
                            <td class="text-left">Lavish Singh</td>
                            <td>Sr TE</td>
                            <td>6354598017</td>
                            <td>5</td>
                            <td class="amt-bg">5000</td>
                            <td>14</td>
                            <td class="amt-bg">7150</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>19</td>
                            <td class="amt-bg">12150</td>
                            <td>19489</td>
                        </tr>

                        <tr class="total-row">
                            <th colspan="4">Group IV Total</th>
                            <th>35</th>
                            <th>35030</th>
                            <th>77</th>
                            <th>38610</th>
                            <th>0</th>
                            <th>0</th>
                            <th>112</th>
                            <th>73640</th>
                            <th></th>
                        </tr>

                        <tr style="background:#e9b3b3;font-weight:bold;">
                            <th colspan="4">Total (Group I, II, III, IV)</th>
                            <th>124</th>
                            <th>119900</th>
                            <th>307</th>
                            <th>148520</th>
                            <th>0</th>
                            <th>0</th>
                            <th>431</th>
                            <th>268420</th>
                            <th></th>
                        </tr>

                        <tr>
                            <th colspan="14" class="group-head" style="background:#ded7f0;">Prosecution Squad</th>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td class="text-left">K C Katariya</td>
                            <td>CTI & IC</td>
                            <td>9825549897</td>
                            <td>5</td>
                            <td class="amt-bg">4750</td>
                            <td>16</td>
                            <td class="amt-bg">6850</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>21</td>
                            <td class="amt-bg">11600</td>
                            <td>19489 / 19484 / 16506</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td class="text-left">Brijesh Nagar</td>
                            <td>Dy CTI / PNU</td>
                            <td>9079327809</td>
                            <td>8</td>
                            <td class="amt-bg">3340</td>
                            <td>18</td>
                            <td class="amt-bg">7770</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>26</td>
                            <td class="amt-bg">11110</td>
                            <td>19924 / 19223</td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td class="text-left">Sitaram Sharma</td>
                            <td>Dy CTI</td>
                            <td>9079243508</td>
                            <td>7</td>
                            <td class="amt-bg">6850</td>
                            <td>30</td>
                            <td class="amt-bg">15600</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>37</td>
                            <td class="amt-bg">22450</td>
                            <td>12833 / 15635</td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td class="text-left">Balwantsingh</td>
                            <td>Dy CTI</td>
                            <td>9737419995</td>
                            <td>7</td>
                            <td class="amt-bg">5950</td>
                            <td>14</td>
                            <td class="amt-bg">11510</td>
                            <td>0</td>
                            <td class="amt-bg">0</td>
                            <td>21</td>
                            <td class="amt-bg">17460</td>
                            <td>20939 / 12915 / 12916 / 12547</td>
                        </tr>

                        <tr style="background:#e6a0a0;font-weight:bold;">
                            <th colspan="4">Prosecution Squad Total</th>
                            <th>27</th>
                            <th>20890</th>
                            <th>78</th>
                            <th>41730</th>
                            <th>0</th>
                            <th>0</th>
                            <th>105</th>
                            <th>62620</th>
                            <th></th>
                        </tr>

                        <tr style="background:#bfe3b4;font-weight:bold;font-size:15px;">
                            <th colspan="4">Grand Total</th>
                            <th>151</th>
                            <th>140790</th>
                            <th>385</th>
                            <th>190250</th>
                            <th>0</th>
                            <th>0</th>
                            <th>536</th>
                            <th>331040</th>
                            <th></th>
                        </tr>


                    </table>

                </div>
            </div>

        </div>
    </div>
@endsection
