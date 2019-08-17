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
    </style>
@endsection
@section('content')
    <!-- page title -->
    <section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb">
                        <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="@@page-link">Our Helpin Plan</a></li>
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
                                <p class="mb-0">हमारे इस मोदीनामा कार्यक्रम में आप एक विवरण से केवल 11 पंजीकरण मुफ़्त  कर सकते हैं ये ध्यान रहे कि उनमें से कोई आई डी अस्वीकृत होती है तो समान विवरण वाली सभी आई डी नेग्लेक्ट हो जाएँगी मतलब उन पर कोई गेट हेल्प नहीं आएगी केवल लॉगिन हो सकती हैं और रिजेक्टेड वाली बिल्कुल ब्लॉक्ड हो जाएगी पुनः कभी नहीं सक्रिय हो सकेगी और दोबारा नया पंजीकरण भी नहीं होगा|</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">02</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">यहाँ पर केवल 2 तरह का दान उपलब्ध है 500 और 1000 का जिसमें आधा पिन के रूप में इस्तेमाल होगा और आधा गिव हेल्प लिंक जाएगा आई डी पूर्ण सक्रिय होने के बाद सिंगल लाइन इनकम बनेगी 500 पर 750 और 1000 पर 1500 होने के बाद गेट हेल्प लिंक मिलेगा|</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">03</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">आपकी आई डी सक्रिय होने के बाद कंपनी सिंगल लाइन में चली जाती है और आपके बाद आने वाली सभी नई आई डी से 2% इनकम मिलने लगती है 750/1500 होने के कुछ समय बाद शून्य हो जाएगी उसके बाद आपको कोई दानी होने पर दान की प्राप्ति हो जाएगी पुनः आपको 500 या 1000 का दान करना होगा|</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">04</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">दान स्वीकार करने के बाद पुनः दान देने की पंक्ति में लग जाएँगे और दान देने के बाद फिर से सिंगल लाइन इनकम बनेगी यही प्रक्रिया अनुबंध के हिसाब से चलती रहेगी|</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">05</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">यदि आपके डाइरेक्ट में कोई नहीं है तो केवल 5 बार ही दान लेने के हकदार होंगे यदि 2 डाइरेक्ट सक्रिय आई डी है तो 10 बार यदि 5 डाइरेक्ट है तो 20 बार और यदि 10 या अधिक डाइरेक्ट में सक्रिय आई डी हैं तो हमेशा लेन-देन चलता रहेगा|</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">06</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">सभी आई डी को 7500 हेल्पिंग इनकम मिलने के बाद नई पिन की ज़रूरत होगी उस समय पर आप अपने दान की राशि 500 या 1000 में बदल भी सकते हैं|</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">07</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">वर्किंग इनकम प्रथम पंक्ति से 20% द्वितीय पंक्ति से 4% तृतीय पंक्ति से 3% चतुर्थ पंक्ति से 2% और पंचम पंक्ति से 1% हर बार गिव हेल्प स्वीकार होने पर मिलेगी और ये राशि 2 भागों में बँट जाएगी आधा पिन वॉलेट में और आधा फंड वॉलेट में चली जाएगी फंड वॉलेट से राशि बिना किसी शर्त के ई-पिन वॉलेट में ट्रान्स्फर की जा सकती है जो पिन बनाने में प्रयोग होगी|</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">08</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">वर्किंग इनकम का आहरण कम से कम 500 अधिकतम 3000 प्रतिदिन 500 के गुणांक में कर सकते हैं| पहला हेल्पिंग गेट हेल्प 2 घंटे तक और दूसरा 24 घंटे के बाद तथा तीसरा गेट हेल्प हमेशा 36 घंटे के बाद कभी भी दानी के उपलब्धता के ऊपर निर्भर करेगा|</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">09</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">लिंक का समय सोमवार से शनिवार सुबह 10 बजे से शाम के 4 बजे तक रहेगा रविवार को पूर्णतः लिंक बंद रहेगा और समय-समय पर किसी अवकाश आदि होने पर एक दिन पहले से लिंक बंद होने की सूचना समाचार पटल पर  दी जाएगी लिंक अस्वीकार करने का समय 8 घंटे दिया जाएगा एक बार 12 घंटे समय दान लेने वाले के द्वारा ही बढ़ाया जा सकता है कोई अस्वीकृत  आई डी दोबारा किसी हालत में सक्रिय नहीं होगी|</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">10</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">सिंगल लाइन वाली इनकम गेट हेल्प लिंक और गिव हेल्प लिंक के मध्यांतर में अवरोधित रहेगी गिव हेल्प देने के बाद फिर से आरंभ हो जाएगी|</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">11</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">सिंगल लाइन इनकम की गणना कोई डाइरेक्ट न होने पर 2% होगी,यदि 2 डाइरेक्ट है तब 3% यदि 5 डाइरेक्ट है तो 4% और यदि 10 या अधिक डाइरेक्ट सक्रिय लोग हैं तो 5% की गणना प्रत्येक नई आई डी से होगी|</p>
                            </div>
                        </li>
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">12</span></div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <p class="mb-0">यहाँ पर एक स्वचालित जादुई कुंड भी है जो कोई अपने डाइरेक्ट में 5 सक्रिय आई डी किसी भी राशि से कर लेता है वो इसका पात्र हो जाता है जिसकी सूचना मोबाइल पर भी भेजी जाएगी और वो पूल वॉलेट में जाकर अपनी स्वीकृति प्रदान करता है तभी उसको 2000 का दान पूल के लिए करना पड़ता है दान स्वीकार होते ही कुंड में प्रवेश मिल जाता है कुल 20 लोगों का कुंड बनाया गया है आपके प्रवेश करते ही सबसे पहली वाली आई डी कुंड से बाहर हो जाएगी और उसके पूल वॉलेट में तुरंत 10000 की राशि मिल जाएगी जिसको फंड वॉलेट में ले जाकर आहरण कर सकते हैं और इसी प्रकार से हर 5 डाइरेक्ट पर एक कुंड प्रवेश मिलेगा आप जिस प्रवेश को अस्वीकार कर देंगे वो रद्द माना जाएगा|</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <h3 class="text-center">मोदीनामा सिंगल लाइन लेखाचित्र स्वरूप</h3>
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
                                <h2 class="text-center heading-color">मोदीनामा स्वचालित जादुई कुंड स्वरूप</h2>
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
                                                            <a href="#" class="btn btn-primary btn-sm">Pool Amount: 10000</a>
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
            </div>
        </div>
    </section>
    <!-- /notice -->

@endsection