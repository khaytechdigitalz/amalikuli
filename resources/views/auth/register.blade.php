@extends('layouts.auth')

@section('contents')
    <main class="my-5">

        <x-jet-validation-errors class="mb-4 alert-danger alert-dismissible alert"/>


        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div class="container">
            <form method="POST" action="{{ route('register') }}" id="myForm" enctype="multipart/form-data">
                @csrf
                <div id="wizard">
                    <h3>
                        <div class="media">
                            <div class="bd-wizard-step-icon"><i class="mdi mdi-account-outline"></i></div>
                            <div class="media-body">
                                <div class="bd-wizard-step-title">Personal Details</div>
                                <div class="bd-wizard-step-subtitle">Step 1</div>
                            </div>
                        </div>
                    </h3>
                    <section>
                        <div class="content-wrapper">
                            <h4 class="section-heading">Enter your Personal details </h4>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="firstName" >First Name</label>
                                    <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lastName" >Last Name</label>
                                    <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="phoneNumber">Date of Birth</label>
                                    <input type="date" name="dob" id="dob" class="form-control" placeholder="Date of Birth" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="emailAddress" >Email Address</label>
                                    <input type="email" name="email" id="emailAddress" class="form-control" placeholder="Email Address" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="gender">Gender</label>  <br />
                                    <select name="gender" id="gender" class="form-control-lg" required style="width: 100%">
                                        <option selected>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="agent" >Agent-type</label>  <br />
                                    <select id="agent" name="ag" class="form-control-lg" required style="width: 100%">
                                        <option value="agent" selected> Agent </option>
                                        {{--                                            <option value="sub_agent"> Sub Agent </option>--}}
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="password" >Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your Password" required>
                                </div>
                            </div>
                        </div>
                    </section>
                    <h3>
                        <div class="media">
                            <div class="bd-wizard-step-icon"><i class="mdi mdi-bank"></i></div>
                            <div class="media-body">
                                <div class="bd-wizard-step-title">BUSINESS INFORMATION</div>
                                <div class="bd-wizard-step-subtitle">Step 2</div>
                            </div>
                        </div>
                    </h3>
                    <section>
                        <div class="content-wrapper">
                            <h4 class="section-heading">Enter your BUSINESS INFORMATION</h4>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="businessName" >Business Name</label>
                                    <input type="text" name="businessName" id="businessName" class="form-control" placeholder="Business Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="businessAddress" >Business Address</label>
                                    <input type="text" name="businessAddress" id="businessAddress" class="form-control" placeholder="Enter Your Address">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="businessPhoneno" >Business Phone Number</label>
                                    <input type="number" name="businessPhoneno" id="businessPhoneno" class="form-control" placeholder="Enter Your Business Phone Number">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="lga" >Local government</label>
                                    <input type="text" name="lga" id="lga" class="form-control" placeholder="Local government">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="businessType" >Select Agent Business type</label>
                                    <select name="businessType" id="businessType" class="form-control-lg" style="width: 100%">
                                        <option value="Sole Proprietorship">Sole Proprietorship</option>
                                        <option value="Partnership">Partnership</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">

                                    <label for="state">State</label> <br />
                                    <select name="state" id="state" class="form-control-lg" style="width: 100%" >
                                        <option value="" selected="" disabled="">--Select state--</option>
                                        <option value="1">Abia</option>
                                        <option value="2">Adamawa</option>
                                        <option value="3">Akwa Ibom</option>
                                        <option value="4">Anambra</option>
                                        <option value="5">Bauchi</option>
                                        <option value="6">Bayelsa</option>
                                        <option value="7">Benue</option>
                                        <option value="8">Borno</option>
                                        <option value="9">Cross River</option>
                                        <option value="10">Delta</option>
                                        <option value="11">Ebonyi</option>
                                        <option value="12">Edo</option>
                                        <option value="13">Ekiti</option>
                                        <option value="14">Enugu</option>
                                        <option value="15">FCT</option>
                                        <option value="16">Gombe</option>
                                        <option value="17">Imo</option>
                                        <option value="18">Jigawa</option>
                                        <option value="19">Kaduna</option>
                                        <option value="20">Kano</option>
                                        <option value="21">Katsina</option>
                                        <option value="22">Kebbi</option>
                                        <option value="23">Kogi</option>
                                        <option value="24">Kwara</option>
                                        <option value="25">Lagos</option>
                                        <option value="26">Nassarawa</option>
                                        <option value="27">Niger</option>
                                        <option value="28">Ogun</option>
                                        <option value="29">Ondo</option>
                                        <option value="30">Osun</option>
                                        <option value="31">Oyo</option>
                                        <option value="32">Plateau</option>
                                        <option value="33">Rivers</option>
                                        <option value="34">Sokoto</option>
                                        <option value="35">Taraba</option>
                                        <option value="36">Yobe</option>
                                        <option value="37">Zamfara</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </section>
                    <h3>
                        <div class="media">
                            <div class="bd-wizard-step-icon"><i class="mdi mdi-account-check-outline"></i></div>
                            <div class="media-body">
                                <div class="bd-wizard-step-title">ACCOUNT INFORMATION</div>
                                <div class="bd-wizard-step-subtitle">Step 3</div>
                            </div>
                        </div>
                    </h3>
                    <section>
                        <div class="content-wrapper">
                            <h4 class="section-heading mb-5">ACCOUNT INFORMATION</h4>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="accountNumber" >Account Number</label>
                                    <input type="number" name="accountNumber"  class="form-control" placeholder="Account Number" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lastName" >Account Name</label>
                                    <input type="text" name="accountName"  class="form-control" placeholder="Account Name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="bankName">Bank</label>
                                    <select class="form-control-lg" name="bankName" required style="width: 100%" >
                                        <option value="" selected="" disabled="">--Select bank--</option>
                                        <option value="1">Access Bank</option>
                                        <option value="2">Citibank</option>
                                        <option value="3">Diamond Bank</option>
                                        <option value="4">Dynamic Standard Bank</option>
                                        <option value="5">Ecobank Nigeria</option>
                                        <option value="6">Fidelity Bank Nigeria</option>
                                        <option value="7">First Bank of Nigeria</option>
                                        <option value="8">First City Monument Bank</option>
                                        <option value="9">Guaranty Trust Bank</option>
                                        <option value="10">Heritage Bank Plc</option>
                                        <option value="11">Jaiz Bank</option>
                                        <option value="12">Keystone Bank Limited</option>
                                        <option value="13">Providus Bank Plc</option>
                                        <option value="14">Polaris Bank</option>
                                        <option value="15">Stanbic IBTC Bank Nigeria Limited</option>
                                        <option value="16">Standard Chartered Bank</option>
                                        <option value="17">Sterling Bank</option>
                                        <option value="18">Suntrust Bank Nigeria Limited</option>
                                        <option value="19">Union Bank of Nigeria</option>
                                        <option value="20">United Bank for Africa</option>
                                        <option value="21">Unity Bank Plc</option>
                                        <option value="22">Wema Bank</option>
                                        <option value="23">Zenith Bank</option>
                                        <option value="345">AACB Microfinance Bank Limited</option>
                                        <option value="346">AB Microfinance Bank Limited</option>
                                        <option value="347">Abatete Microfinance Bank Limited</option>
                                        <option value="348">ABC Microfinance Bank Limited</option>
                                        <option value="349">Abia State University Microfinance Bank Limited</option>
                                        <option value="350">Abigi Microfinance Bank Limited</option>
                                        <option value="351">Abokie Microfinance Bank Limited</option>
                                        <option value="352">Abucoop Microfinance Bank Limited</option>
                                        <option value="353">Accion Microfinance Bank Limited</option>
                                        <option value="354">ACE Microfinance Bank Limited</option>
                                        <option value="355">Acheajebwa Microfinance Bank Limited</option>
                                        <option value="356">Achina Microfinance Bank Limited</option>
                                        <option value="357">Active Point Microfinance Bank Limited</option>
                                        <option value="358">Acuity Microfinance Bank Limited</option>
                                        <option value="359">Adaigbo Microfinance Bank Limited</option>
                                        <option value="360">Adazi- Nnukwu Microfinance Bank Limited</option>
                                        <option value="361">Adazi-Enu Microfinance Bank Limited</option>
                                        <option value="362">Addossar Microfinance Bank Limited</option>
                                        <option value="363">Adkolm-Emerald Microfinance Bank LImited</option>
                                        <option value="364">Advance Microfinance Bank Limited</option>
                                        <option value="365">Afemai Microfinance Bank Limited</option>
                                        <option value="366">Afotamodi-Ogunola Microfinance Bank Limited</option>
                                        <option value="367">Mainstreet Microfinance Bank Limited</option>
                                        <option value="368">Agbarho Microfinance Bank Limited</option>
                                        <option value="369">Agbowu Microfinance Bank Limited</option>
                                        <option value="370">Agosasa Microfinance Bank Limited</option>
                                        <option value="371">Aguda Titun Microfinance Bank Limited</option>
                                        <option value="372">Aguleri Microfinance Bank Limited</option>
                                        <option value="373">Ahetou Microfinance Bank Limited</option>
                                        <option value="374">Ahmadu Bello University Microfinance Bank Limited</option>
                                        <option value="375">Aiyepe Microfinance Bank Limited</option>
                                        <option value="376">Aja-Yejebwo Microfinance Bank Limited</option>
                                        <option value="377">Ajeko Microfinance Bank Limited</option>
                                        <option value="378">Ajewole Microfinance Bank Limited</option>
                                        <option value="379">Ajiya Microfinance Bank Limited</option>
                                        <option value="380">Ajose Microfinance Bank Limited</option>
                                        <option value="381">Ajuta Microfinance Bank Limited</option>
                                        <option value="382">Akalabo Microfinance Bank Limited</option>
                                        <option value="383">AKCOFED Microfinance Bank Limited</option>
                                        <option value="384">Akokwa Microfinance Bank Limited</option>
                                        <option value="385">Akpo Microfinance Bank Limited</option>
                                        <option value="386">Aku Diewa Microfinance Bank Limited</option>
                                        <option value="387">Akwengwu Microfinance Bank Limited</option>
                                        <option value="388">Alache Microfinance Bank Limited</option>
                                        <option value="389">Al-Barakah Microfinance Bank Limited</option>
                                        <option value="390">Alekun Microfinance Bank Limited</option>
                                        <option value="391">Aliero Microfinance Bank Limited</option>
                                        <option value="392">Alkaleri Microfinance Bank Limited</option>
                                        <option value="393">All Seasons Microfinance Bank Limited</option>
                                        <option value="394">All Workers Microfinance Bank Limited</option>
                                        <option value="395">Aloaye Microfinance Bank Limited</option>
                                        <option value="396">Alor Microfinance Bank Limited</option>
                                        <option value="397">Altitude Microfinance Bank Limited</option>
                                        <option value="398">Alvana Microfinance Bank Limited</option>
                                        <option value="399">Amaifeke Microfinance Bank Limited</option>
                                        <option value="400">Amazu Microfinance Bank Limited</option>
                                        <option value="401">Amba Microfinance Bank Limited</option>
                                        <option value="402">Amegy Microfinance Bank Limited</option>
                                        <option value="403">AMJU-Unique Microfinance Bank Limited</option>
                                        <option value="404">Amoye Microfinance Bank Limited</option>
                                        <option value="405">Amram Microfinance Bank Limited</option>
                                        <option value="406">Amucha Microfinance Bank Limited</option>
                                        <option value="407">Amuro Microfinance Bank Limited</option>
                                        <option value="408">Anchorage Microfinance Bank Limited</option>
                                        <option value="409">Aniocha Microfinance Bank Limited</option>
                                        <option value="410">Annointed Microfinance Bank Limited</option>
                                        <option value="411">Anya Microfinance Bank Limited</option>
                                        <option value="412">Aogo Microfinance Bank Limited</option>
                                        <option value="413">Apa Microfinance Bank Limited</option>
                                        <option value="414">Apeks Microfinance Bank LImited</option>
                                        <option value="415">Apex Trust Microfinance Bank Limited</option>
                                        <option value="416">Apple Microfinance Bank Limited</option>
                                        <option value="417">Aramoko Microfinance Bank Limited</option>
                                        <option value="418">Arochukwu Microfinance Bank Limited</option>
                                        <option value="419">Arondizuogu Microfinance Bank Limited</option>
                                        <option value="420">Asha Microfinance Bank Limited</option>
                                        <option value="421">Aspire Microfinance Bank LImited</option>
                                        <option value="422">Asset Matrix Microfinance Bank Limited</option>
                                        <option value="423">Assets Microfinance Bank Limited</option>
                                        <option value="424">Associated Investment Trust Microfinance Bank Limi</option>
                                        <option value="425">Astra Polaris Microfinance Bank Limited</option>
                                        <option value="426">Atlas Microfinance Bank Limited</option>
                                        <option value="427">Atyap Microfinance Bank Limited</option>
                                        <option value="428">Auchi Microfinance Bank Limited</option>
                                        <option value="429">Avunegbe Microfinance Bank Limited</option>
                                        <option value="430">Avyi Microfinance Bank Limited</option>
                                        <option value="431">Awe Microfinance Bank Limited</option>
                                        <option value="432">Awgbu Microfinance Bank Limited</option>
                                        <option value="433">Awka Microfinance Bank Limited</option>
                                        <option value="434">Awka-Etiti Microfinance Bank Limited</option>
                                        <option value="435">Awkuzu Microfinance Bank Limited</option>
                                        <option value="436">Ayete Microfinance Bank Limited</option>
                                        <option value="437">AZSA Microfinance Bank Limited</option>
                                        <option value="438">Babba Microfinance Bank Limited</option>
                                        <option value="439">Babura Microfinance Bank Limited</option>
                                        <option value="440">Bakassi Microfinance Bank Limited</option>
                                        <option value="441">Balera Microfinance Bank Limited</option>
                                        <option value="442">Balogun Ajikobi Microfinance Bank Limited</option>
                                        <option value="443">Balogun Fulani Microfinance Bank Limited</option>
                                        <option value="444">Balogun Gambari Microfinance Bank Limited</option>
                                        <option value="445">Bam Microfinance Bank Limited</option>
                                        <option value="446">Bama Microfinance Bank Limited</option>
                                        <option value="447">Bancorp Microfinance Bank Limited</option>
                                        <option value="448">Barnawa Microfinance Bank Limited</option>
                                        <option value="449">Bauchi Investment Corporation MFB Limited</option>
                                        <option value="450">Bawyi Microfinance Bank Limited</option>
                                        <option value="451">Bayajidda Microfinance Bank Limited</option>
                                        <option value="452">Bayetin MFB Microfinance Bank Limited</option>
                                        <option value="453">Bayetin Microfinance Bank Limited</option>
                                        <option value="454">Bejin-Doko Microfinance Bank Limited</option>
                                        <option value="455">Berachah Microfinance Bank Limited</option>
                                        <option value="456">Best Star Microfinance Bank Limited</option>
                                        <option value="457">Bestway Microfinance Bank Limited</option>
                                        <option value="458">Bethel Microfinance Bank Limited</option>
                                        <option value="459">Bethseda Microfinance Bank Limited</option>
                                        <option value="460">BFL Microfinance Bank Limited</option>
                                        <option value="461">Bigthana Microfinance Bank Limited</option>
                                        <option value="462">Birni Microfinance Bank Limited</option>
                                        <option value="463">BishopGate Microfinance Bank Limited</option>
                                        <option value="464">Biyama Microfinance Bank Limited</option>
                                        <option value="465">Biztrust Microfinance Bank LImited</option>
                                        <option value="466">Blue Intercontinental Microfinance Bank Limited</option>
                                        <option value="467">Blue Ridge Microfinance Bank Limited</option>
                                        <option value="468">Bmazazhin Microfinance Bank Limited</option>
                                        <option value="469">BOI Microfinance Bank Limited</option>
                                        <option value="470">Boji Boji Microfinance Bank Limited</option>
                                        <option value="471">Boluwaduro Microfinance Bank Limited</option>
                                        <option value="472">Bonded Microfinance Bank Limited</option>
                                        <option value="473">Bonghe Microfinance Bank Limited</option>
                                        <option value="474">Borgu Microfinance Bank Limited</option>
                                        <option value="475">Borstal Microfinance Bank Limited</option>
                                        <option value="476">Bosak Microfinance Bank Limited</option>
                                        <option value="477">Bowen Microfinance Bank Limited</option>
                                        <option value="478">Bowman Microfinance Bank Limited</option>
                                        <option value="479">Brass Microfinance Bank Limited</option>
                                        <option value="480">Briyth Covenant Microfinance Bank Limited</option>
                                        <option value="481">Broadview Microfinance Bank Limited</option>
                                        <option value="482">Brooks Microfinance Bank Limited</option>
                                        <option value="483">Bungudu Microfinance Bank Limited</option>
                                        <option value="484">Bunkasa Microfinance Bank Limited</option>
                                        <option value="485">Business Support Microfinance Bank Limited</option>
                                        <option value="486">Busu Microfinance Bank Limited</option>
                                        <option value="487">CAFON Microfinance Bank Limited</option>
                                        <option value="488">Calabar Microfinance Bank Limited</option>
                                        <option value="489">Calm Microfinance Bank Limited</option>
                                        <option value="490">Capstone Microfinance Bank Limited</option>
                                        <option value="491">Cardinal Rock Microfinance Bank Limited</option>
                                        <option value="492">Caretaker Microfinance Bank Limited</option>
                                        <option value="493">Cash Cow Microfinance Bank Limited</option>
                                        <option value="494">Castle Microfinance Bank Limited</option>
                                        <option value="495">Catland Microfinance Bank Limited</option>
                                        <option value="496">Cedar Microfinance Bank Limited</option>
                                        <option value="497">Chanelle Microfinance Bank Limited</option>
                                        <option value="498">Chartwell Microfinance Bank Limited</option>
                                        <option value="499">Chelsea Microfinance Bank Limited</option>
                                        <option value="500">Chevron Employee Co-operative MFB</option>
                                        <option value="501">Chibueze Microfinance Bank Limited</option>
                                        <option value="502">Chidera Microfinance Bank Limited</option>
                                        <option value="503">Chigbe-Yaji Microfinance Bank Limited</option>
                                        <option value="504">Chikum Microfinance Bank Limited</option>
                                        <option value="505">Chimham Microfinance Bank Limited</option>
                                        <option value="506">Chrisore Microfinance Bank Limited</option>
                                        <option value="507">Chukwunenye Microfinance Bank Limited</option>
                                        <option value="508">CIT Microfinance Bank Limited</option>
                                        <option value="509">Citadel Microfinance Bank Limited</option>
                                        <option value="510">City Mission Methodist Microfinance Bank Limited</option>
                                        <option value="511">Civic Microfinance Bank Limited</option>
                                        <option value="512">Coalcamp Microfinance Bank Limited</option>
                                        <option value="513">Coastline Microfinance Bank Limited</option>
                                        <option value="514">Coconut Avenue Microfinance Bank Limited</option>
                                        <option value="515">Combined Benefits Microfinance Bank Limited</option>
                                        <option value="516">Compass Microfinance Bank Limited</option>
                                        <option value="517">Complete Trust Microfinance Bank Limited</option>
                                        <option value="518">Confidence Microfinance Bank Limited</option>
                                        <option value="519">Confluence Microfinance Bank Limited</option>
                                        <option value="520">Conpro Microfinance Bank Limited</option>
                                        <option value="521">Consumer Microfinance Bank Limited</option>
                                        <option value="522">Coral Microfinance Bank Limited</option>
                                        <option value="523">Corestep Microfinance Bank Limited</option>
                                        <option value="524">Cosmopolitan Microfinance Bank Ltd</option>
                                        <option value="525">Covenant University Microfinance Bank Limited</option>
                                        <option value="526">Cowries Microfinance Bank Limited</option>
                                        <option value="527">Credit Express Microfinance Bank Limited</option>
                                        <option value="528">Credit Plus Microfinance Bank Limited</option>
                                        <option value="529">CreditLink Microfinance Bank Limited</option>
                                        <option value="530">Creekline Microfinance Bank Limited</option>
                                        <option value="531">Crest Microfinance Bank Limited</option>
                                        <option value="532">Crowned Eagle Microfinance Bank Limited</option>
                                        <option value="533">CRUTECH  Microfinance Bank Limited</option>
                                        <option value="534">Crystabel Microfinance Bank Limited</option>
                                        <option value="535">CSD Microfinance Bank Limited</option>
                                        <option value="536">Dadin Kowa Microfinance Bank Limited</option>
                                        <option value="537">Daffo Mangai Microfinance Bank Limited</option>
                                        <option value="538">Dambatta Microfinance Bank Limited</option>
                                        <option value="539">Danels Global Microfinance Bank Limited</option>
                                        <option value="540">Dangizhi Microfinance Bank Limited</option>
                                        <option value="541">Darazo Microfinance Bank Limited</option>
                                        <option value="542">DCFA-Universal Microfinance Bank Limited</option>
                                        <option value="543">Decency Microfinance Bank Limited</option>
                                        <option value="544">DEC-Enugu Microfinance Bank Limited</option>
                                        <option value="545">Desmonarchy Microfinance Bank Limited</option>
                                        <option value="546">Destiny Microfinance Bank Limited</option>
                                        <option value="547">Diobu Microfinance Bank Limited</option>
                                        <option value="548">Dolphin Microfinance Bank Limited</option>
                                        <option value="549">Dominion Microfinance Bank Limited</option>
                                        <option value="550">Dutse Microfinance Bank Limited</option>
                                        <option value="551">Eagle Flight Microfinance Bank Limited</option>
                                        <option value="552">East Gate Microfinance Bank Limited</option>
                                        <option value="553">Eastman Microfinance Bank Limited</option>
                                        <option value="554">e-Barclays Microfinance Bank Limited</option>
                                        <option value="555">Ebedi Microfinance Bank Limited</option>
                                        <option value="556">Ebonyi State University Microfinance Bank Limited</option>
                                        <option value="557">Ebu Microfinance Bank Limited</option>
                                        <option value="558">Echo Microfinance Bank Limited</option>
                                        <option value="559">Edo Microfinance Bank Limited</option>
                                        <option value="560">Eduek Microfinance Bank Limited</option>
                                        <option value="561">Edumana Microfinance Bank Limited</option>
                                        <option value="562">Egbe Microfinance Bank Limited</option>
                                        <option value="563">Ehor Microfinance Bank Limited</option>
                                        <option value="564">Ejiamatu Microfinance Bank Ltd</option>
                                        <option value="565">Ekimogun Microfinance Bank Limited</option>
                                        <option value="566">Ekondo Microfinance Bank Limited</option>
                                        <option value="567">Ekuombe Microfinance Bank Limited</option>
                                        <option value="568">Ekwulobia Microfinance Bank Limited</option>
                                        <option value="569">Elim Microfinance Bank Limited</option>
                                        <option value="570">Endwell Microfinance Bank Limited</option>
                                        <option value="571">Enterprise Microfinance Bank Limited</option>
                                        <option value="572">Enugu-Ukwu Microfinance Bank Limited</option>
                                        <option value="573">Equator Microfinance Bank Limited</option>
                                        <option value="574">Equinox Microfinance Bank Limited</option>
                                        <option value="575">Ere City Microfinance Bank Limited</option>
                                        <option value="576">Eruwon Microfinance Bank Limited</option>
                                        <option value="577">Esan Microfinance Bank Limited</option>
                                        <option value="578">Eso-E Microfinance Bank Limited</option>
                                        <option value="579">Estate Microfinance Bank Limited</option>
                                        <option value="580">Ethics Microfinance Bank Limited</option>
                                        <option value="581">Everest Microfinance Bank Limited</option>
                                        <option value="582">EWT Microfinance Bank Limited</option>
                                        <option value="583">Excel Microfinance Bank Limited</option>
                                        <option value="584">Excellent Microfinance Bank Limited</option>
                                        <option value="585">Ezebo Microfinance Bank Limited</option>
                                        <option value="586">Fadan Chawai Microfinance Bank Limited</option>
                                        <option value="587">Fahimta Microfinance Bank Limited</option>
                                        <option value="588">Faith Microfinance Bank Limited</option>
                                        <option value="589">Fame Microfinance Bank Limited</option>
                                        <option value="590">FBN Microfinance Bank Limited</option>
                                        <option value="591">FCE Obudu Microfinance Bank Limited</option>
                                        <option value="592">FEDETH Co-op Microfinance Bank Limited</option>
                                        <option value="593">FEDPOLY Microfinance Bank Limited</option>
                                        <option value="594">Fidfund Microfinance Bank Limited</option>
                                        <option value="595">FIMS Microfinance Bank Limited</option>
                                        <option value="596">Finatrust Microfinance Bank Limited</option>
                                        <option value="597">Finex Microfinance Bank Limited</option>
                                        <option value="598">First Ideal Microfinance Bank Limited</option>
                                        <option value="599">First Index Microfinance Bank Limited</option>
                                        <option value="600">First Lowland Microfinance Bank Limited</option>
                                        <option value="601">First Mutual Microfinance Bank Limited</option>
                                        <option value="602">First Option Microfinance Bank Limited</option>
                                        <option value="603">First Royal Microfinance Bank Limited</option>
                                        <option value="604">Fiyinfolu Microfinance Bank Limited</option>
                                        <option value="605">Flourish Microfinance Bank LImited</option>
                                        <option value="606">Foresight Microfinance Bank Limited</option>
                                        <option value="607">Fortis Microfinance Bank Limited</option>
                                        <option value="608">Forward Microfinance Bank Limited</option>
                                        <option value="609">Freedom (Lagos) Microfinance Bank Limited</option>
                                        <option value="610">Frontline Microfinance Bank Limited</option>
                                        <option value="611">Fufore Microfinance Bank Limited</option>
                                        <option value="612">FUT Minna Microfinance Bank Limited</option>
                                        <option value="613">FUTO Microfinance Bank Limited</option>
                                        <option value="614">Future Growth Microfinance Bank Limited</option>
                                        <option value="615">Gaa Akanbi Microfinance Bank Limited</option>
                                        <option value="616">Gains Microfinance Bank Limited</option>
                                        <option value="617">Gamawa Microfinance Bank Limited</option>
                                        <option value="618">Gapbridge Microfinance Bank Limited</option>
                                        <option value="619">Garden City Microfinance Bank Limited</option>
                                        <option value="620">Garewa Microfinance Bank Limited</option>
                                        <option value="621">Garki Microfinance Bank Limited</option>
                                        <option value="622">Garu Microfinance bank Limited</option>
                                        <option value="623">Gashua Microfinance Bank Limited</option>
                                        <option value="624">Gbede Microfinance Bank Limited</option>
                                        <option value="625">Gboko Microfinance Bank Limited</option>
                                        <option value="626">Gidauniya Alheri MFB Limited</option>
                                        <option value="627">Gideon Trust Microfinance Bank Limited</option>
                                        <option value="628">Girei Microfinance Bank Limited</option>
                                        <option value="629">Giwa Microfinance Bank Limited</option>
                                        <option value="630">Global Initiative Microfinance Bank Limited</option>
                                        <option value="631">Global Trust Microfinance Bank Limited</option>
                                        <option value="632">Glory Microfinance Bank Limited</option>
                                        <option value="633">Gobarau Microfinance Bank Limited</option>
                                        <option value="634">Gold Microfinance Bank Limited</option>
                                        <option value="635">Golden Choice Microfinance Bank Limited</option>
                                        <option value="636">Golden Funds Microfinance Bank Limited</option>
                                        <option value="637">Goldman Microfinance Bank Limited</option>
                                        <option value="638">Gombe Microfinance Bank Limited</option>
                                        <option value="639">Good Neighbors Microfinance Bank Limited</option>
                                        <option value="640">Grand Fortress Microfinance Bank Limited</option>
                                        <option value="641">Grants Microfinance Bank Limited</option>
                                        <option value="642">Grassroot Microfinance Bank Limited</option>
                                        <option value="643">Green Acres Microfinance Bank Limited</option>
                                        <option value="644">Green-Bank Microfinance Bank Limited</option>
                                        <option value="645">Greenfield Lagos Microfinance Bank Limited</option>
                                        <option value="646">Greenland Microfinance Bank Limited</option>
                                        <option value="647">GTI Microfinance Bank Limited</option>
                                        <option value="648">Guddiri Microfinance Bank Limited</option>
                                        <option value="649">Gudusisa Microfinance Bank Limited</option>
                                        <option value="650">Gufax Microfinance Bank Limited</option>
                                        <option value="651">Gulfare Microfinance Bank Limited</option>
                                        <option value="652">Gwadabawa Microfinance bank Limited</option>
                                        <option value="653">Gwong Microfinance Bank Limited</option>
                                        <option value="654">Hillspring Microfinance Bank Limited</option>
                                        <option value="655">Hallowed Microfinance Bank Limited</option>
                                        <option value="656">Halmond Microfinance Bank Limited</option>
                                        <option value="657">Hamda Microfinance Bank Limited</option>
                                        <option value="658">Hamdala Microfinance Bank Limited</option>
                                        <option value="659">Happy Note Microfinance Bank Limited</option>
                                        <option value="660">Harvest Microfinance Bank Limited</option>
                                        <option value="661">Hasal Microfinance Bank Limited</option>
                                        <option value="662">Headstone Microfinance Bank Limited</option>
                                        <option value="663">Hedgeworth Microfinance Bank Limited</option>
                                        <option value="664">Heritage Microfinance Bank Limited</option>
                                        <option value="665">High Street Microfinance Bank Limited</option>
                                        <option value="666">Kuda Microfinance Bank</option>
                                        <option value="667">VFD Microfinance Bank</option>
                                        <option value="668">Ilisan Microfinance Bank</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="bvn" >BVN</label>
                                    <input type="text" name="bvn"  class="form-control" placeholder="BVN" required>
                                </div>
                            </div>
                        </div>
                    </section>
                    <h3>
                        <div class="media">
                            <div class="bd-wizard-step-icon"><i class="mdi mdi-emoticon-outline"></i></div>
                            <div class="media-body">
                                <div class="bd-wizard-step-title">DOCUMENT UPLOAD</div>
                                <div class="bd-wizard-step-subtitle">Step 4</div>
                            </div>
                        </div>
                    </h3>
                    <section>
                        <div class="content-wrapper">
                            <div class="row p-4 rounded g-3">
                                <h6><strong>DOCUMENT UPLOAD</strong></h6>
                                <hr>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="file-1"><span>Utility Bill</span></label>
                                        <input type="file" name="utilityBill" id="file-1" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="file-2"><span>Guarantor Form</span></label>
                                        <input type="file" name="guarantorForm" id="file-2" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="file-3"><span>ID card</span></label>
                                        <input type="file" name="idCard" id="file-3" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="file-4"><span>Passport Photograph</span></label>
                                        <input type="file" name="passportPhotograph" id="file-4" class="form-control" required="">
                                    </div>
                                </div>
                                <!-- End Document Upload -->
                            </div>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </main>
@endsection
