@extends('layouts.app')
@section('styles')
    <style>
        .d-md-table {
            border: 2px solid #ffbc3b!important;
        }
        .section {
            padding-top: 40px;
            padding-bottom: 40px;
        }
        p{
            margin-bottom: 0rem;
        }
        .rounded-circle {
            border-radius: 50%!important;
            width: 40px;
            height: 40px;
            text-align: -webkit-center;
            padding-top: 8px;
            border: 3px solid #182b45!important;
        }
        .mb-0{
            color:#182b45;
            font-weight: 900;
        }
        .table td {
            font-weight: 900;
            color: #182b45;
        }
    </style>
@endsection
@section('content')
    <!-- page title -->
    <section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb">
                        <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="@@page-link">Our Helping Plan</a></li>
                        <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                    </ul>
                    <p class="text-lighten">Please read our plan carefully before Sign-up.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <!-- notice -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="list-unstyled">
                        <!-- notice item -->
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">01</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">Only 3 ids are allowed by same details in this system if any id rejects then every id will be Neglected by same details,Neglected id means only login no get help or withdrawal and rejected id fully blocked no login.</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">02</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">After free registration you  have need to E-pin of 50% give help means 250 OR 500 remain 50% give help link will come for provide help next give help amount 500/1000 and every get help amount 750/1500,total two types give help amount 500 and 1000 possible here.</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">03</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">Your first give help confirmed as active id will go in company single line pool and will get 2% by every new accepted id up to 750/1500 and when will amount zero then you will go in receiver queue and will receive get help link on next sender availability in the system.</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">04</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">After get help accepted you will be in the queue of donor line again and give help accepted again single line income will generate up to 750 or 1500 this process will continue.</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">05</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">If you have not any direct active id then you will get only 5 times get help if you have 2 direct active id any amount then you will get 10 times get help if you have 5 direct active id any amount then you will get help 20 times and if you have 10 or more direct active id any amount then you will get/give unlimited times.</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">06</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">After every 7500 helping get help every id will require a new E-pin of your choice commitment 500 or 1000 amount provide help means you can change your id in 500 or 1000 amount. </p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">07</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">Working level income is 1st level=5%,2nd level=3%,3rd level=2%,4th level=1% and 5th level=1% on every give help accepted amount by team up to 5th levels and total working income will be divided into two parts 50:50 ratio in E-pin wallet and fund wallet you can also transfer amount into E-pin wallet from fund wallet without any boundation amount to create E-pin.</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">08</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">Minimum working withdrawal is 500 and maximum 3000 multiple of 500 every day.First helping get help within 2 hours,second get help after 24 hours and third get help after 36 hours will continue depend on sender availability.</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">09</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">Link time Monday to Saturday 08 AM TO 10 AM. Sunday fully closed link rejection time 8 hours and 12 hours extension one time if any Holiday for link close then will before broadcast on the news portal any rejected/blocked id will not be opened any conditions.</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">10</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">Single line income will calculate after every new id give help accepted and will be paused between get and give help acceptance.</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">11</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">Single line income will calculate 2% no direct required if you have 2 direct active id then 3% if you have 5 direct active id then 4% and if you have 10 or more direct active id then 5% will calculate single line income on every new give help acceptance.</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">12</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">There is a Magical Auto Pool Income also in this system after every 5 direct active id any amount you will eligible for (Auto Magic Pool Board) income with sms alert and enable agree button in the pool wallet for give help 2000 in pool entry and get amount 5000 in fund wallet only 20 id in board pool.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <h3 class="text-center">MUDRASHAKTI SINGLE LINE CHART VIEW</h3>
                </div>
                <div class="table-responsive">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Sr. No.</th>
                                    <th scope="col" class="text-center">Direct ID Requirement</th>
                                    <th scope="col" class="text-center">Give Help Amount</th>
                                    <th scope="col" class="text-center">Get Help Amount</th>
                                    <th scope="col" class="text-center">Income Per Id</th>
                                    <th scope="col" class="text-center">Get Help Limitations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-center">1</th>
                                    <td class="text-center">No ID Required</td>
                                    <td class="text-center">500/1000</td>
                                    <td class="text-center">750/1500</td>
                                    <td class="text-center">2%</td>
                                    <td class="text-center">5 Times</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">2</th>
                                    <td class="text-center">2 ID</td>
                                    <td class="text-center">500/1000</td>
                                    <td class="text-center">750/1500</td>
                                    <td class="text-center">3%</td>
                                    <td class="text-center">10 Times</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">3</th>
                                    <td class="text-center">5 ID</td>
                                    <td class="text-center">500/1000</td>
                                    <td class="text-center">750/1500</td>
                                    <td class="text-center">4%</td>
                                    <td class="text-center">20 Times</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">4</th>
                                    <td class="text-center">10 ID Or More</td>
                                    <td class="text-center">500/1000</td>
                                    <td class="text-center">750/1500</td>
                                    <td class="text-center">5%</td>
                                    <td class="text-center">Unlimited Times</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-5 mb-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 ml-auto bg-primary newsletter-block form-border">
                                <h2 class="text-center heading-color">MUDRASHAKTI MAGICAL AUTO POOL BOARD</h2>
                                <section class="section">
                                    <div class="container">
                                        <div class="row">
                                        @for($i=1;$i<=20;$i++)
                                            <!-- blog post -->
                                                <article class="col-lg-3 col-sm-3 mb-3">
                                                    <div class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
                                                        <i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
                                                        <div class="card-body">
                                                            <p><h5 class="card-title border border-success rounded-circle">{{$i}}</h5></p>
                                                            <p class="card-text">Username: <h5 class="card-title">User {{$i}}</h5></p>
                                                            <p class="card-text">Name: <h5 class="card-title">User {{$i}}</h5></p>
                                                            <a href="#" class="btn btn-primary btn-sm">Pool Amount: 5000</a>
                                                        </div>
                                                    </div>
                                                </article>
                                                <!-- blog post -->
                                            @endfor
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h3><span class="text-danger">NOTE:-</span>Please read the plan carefully before signup our community thank you.</h3>
                </div>
            </div>
        </div>
    </section>
    <!-- /notice -->

@endsection
