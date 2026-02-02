<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head')
</head>
<body class="antialiased">

<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl w-full space-y-2">
        <div class="items-center justify-center mt-8 mb-6">
            <div class="flex flex-wrap items-center justify-between gap-4 mb-2">
                <div class="flex-shrink-0">
                    <a href="/" aria-label="@lang('Return to homepage')">
                        <img class="h-6 w-auto sm:h-7" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png" alt="@lang('DonationBox')">
                    </a>
                </div>
                <div class="flex items-center justify-end min-w-0">
                    @include('components.lang-switcher')
                </div>
            </div>
            <h1 class="text-center text-3xl text-gray-700 mb-8">
                @lang("FAQ")
            </h1>

            @if(env('COUNTRY') == 'ee')
                @php($cc = 'Estonia')
            @elseif(env('COUNTRY') == 'lv')
                @php($cc = 'Latvia')
            @elseif(env('COUNTRY') == 'lt')
                @php($cc = 'Lithuania')
            @endif

            @php($cc_domain = env('COUNTRY'))
            @php
                $countryAdjective = match (env('COUNTRY')) {
                    'ee' => __('Estonian'),
                    'lv' => __('Latvian'),
                    'lt' => __('Lithuanian'),
                    default => __('Estonian'),
                };
            @endphp

            @component('components.faq-card')
                @slot('cardName')
                    whatIsDonationBox
                @endslot
                @slot('cardTitle')
                    @lang("What is a DonationBox?")
                @endslot
                @slot('cardContent')
                    <p>@lang("This is a web application for generating links to direct or regular donation forms for :country and international payment methods. The app allows you to create your own virtual donation box for donations without having to write code or link your website or app to contracts and integrations with banklink.", ['country' => $countryAdjective])</p> <br> <p>
                        @lang("We provide a convenient interface for donors so that they don't have to enter data manually or copy it. The donor only has to follow a link by scanning a QR-code or going to a direct URL-address, enter the amount of donation, choose the transfer type - one-time or regular payment (single or standing order), and choose your bank, Paypal or credit card payment type.")</p>
                @endslot
            @endcomponent

            @component('components.faq-card')
                @slot('cardName')
                    free
                @endslot
                @slot('cardTitle')
                    @lang("Why is DonationBox free?")
                @endslot
                @slot('cardContent')
                    <p>
                        @lang("Currently connecting solutions related to accepting donations is either quite difficult for a person who does not have technical skills, or has a monthly fee, which may be inappropriate in cases where the collection is organized by a private person or an NGO that does not have regular donors.")<br><br>
                        @lang("We believe it is important to make organizing fundraisers in {{$cc}} a quick, convenient, and, most importantly, fee free method for fundraisers.")
                    </p>
                @endslot
            @endcomponent

            @component('components.faq-card')
                @slot('cardName')
                    security
                @endslot
                @slot('cardTitle')
                        @lang("Is this website secure? Isn't it phishing?")
                @endslot
                @slot('cardContent')
                    <p>
                        @lang("In short: Yes, it's safe.")<br><br>

                        @lang("DonationBox is just an intermediary that sends a request to your bank's web page with the account number, the name of the recipient, an explanation, and the amount of the payment. The bank chosen by the user is responsible for the security of the transfer and all actions related to user authentication.")<br><br>

                        @lang("According to all modern standards, we use a secure SSL connection, but we advise you to use additional data encryption tools such as incognito mode, VPN, etc. for anonymity.")
                    </p>
                @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    checkYourBank
                @endslot
                @slot('cardTitle')
                        @lang("How do you check that you really got to your bank's website and not some fake page asking for banking information?")
                    @endslot
                @slot('cardContent')
                    <p>
                        <p><span style="font-weight: 400;">@lang("After selecting your banking method, you may want to pay attention to the URL of the web page to which you were redirected when you click. To do this, open the address bar of the browser window with the bank's website and note that it matches the following domains and is listed by your browser as a ")</span><em><span style="font-weight: 400;">@lang("Secure")</span></em><span style="font-weight: 400;"> @lang("website (in this case, Chrome, Safari and Firefox will show a closed padlock icon next to the address).")</span></p>
                        <h1 style="color: #5e9ca0;">&nbsp;</h1>
                        <p><span style="font-weight: 400;">Swedbank - </span><a href="https://www.swedbank.ee/"><span style="font-weight: 400;">https://www.swedbank.ee/</span></a></p>
                        <p><span style="font-weight: 400;">SEB -</span><a href="https://e.seb.ee/"> <span style="font-weight: 400;">https://e.seb.ee/</span></a></p>
                        <p><span style="font-weight: 400;">LHV - </span><a href="https://www.lhv.ee/"><span style="font-weight: 400;">https://www.lhv.ee/</span></a><span style="font-weight: 400;">&nbsp;</span></p>
                        <p><span style="font-weight: 400;">Coop - </span><a href="https://i.cooppank.ee/"><span style="font-weight: 400;">https://i.cooppank.ee/</span></a><span style="font-weight: 400;">&nbsp;</span></p>
                        <p><span style="font-weight: 400;">Revolut -</span><a href="https://revolut.me"> <span style="font-weight: 400;">https://revolut.me</span></a></p>
                        <p><span style="font-weight: 400;">Paypal - </span><a href="https://www.paypal.com/"><span style="font-weight: 400;">https://www.paypal.com/</span></a></p>
                        <p><span style="font-weight: 400;">Donorbox - </span><a href="https://donorbox.org/"><span style="font-weight: 400;">https://donorbox.org/</span></a><span style="font-weight: 400;">&nbsp;</span></p>
                    </p>
                @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    dataSecurity
                @endslot
                @slot('cardTitle')
                        @lang("Okay, but how do you protect and store my data? Will my transactions be visible to others?")
                    @endslot
                @slot('cardContent')
                    <p>
                        @lang("In short, we do our best to make sure that no one besides you, your bank, and payee knows about your transfer. To make sure it works, we do the following:")<br> <br>

                        <ul class="list-decimal ml-6 break-words">
                            <li>@lang("We don't store your data in a database. Instead, we generate a special link that already contains all the data related to the campaign. The parameters from this link are read by the DonationBox application. Parameters include the campaign name, payment detail, payee's name, IBAN account number / your Revolut.me username / your Paypal.me username / slug for your Donorbox campaign / your UID from SEB.")<br><br>
                                <b>@lang("Example link with parameters:")</b> <a href="https://donationbox.ee/donation?campaign_title=Donate+Estonian+Jewish+Museum&detail=Annetus&payee=Eesti+Juudi+Muuseum+MT%C3%9C&iban=EE312200221037561773&pp=&db=support-estonian-jewish-museum&sebuid=f0233a8a-2c62-414d-a8e0-868d5ca345cb" class="no-underline hover:underline text-blue-800">
                                    https://donationbox.ee/donation?campaign_title=Donate+Estonian+Jewish+Museum&detail=Annetus&payee=Eesti
                                    +Juudi+Muuseum+MT%C3%9C&iban=EE312200221037561773&pp=&db=support-estonian-jewish
                                    -museum&sebuid=f0233a8a-2c62-414d-a8e0-868d5ca345cb</a><br><br>
                            </li>
                            <li>@lang("We only redirect you to the bank page. After logging into the bank, you will see the pre-filled for the transfer. All you have to do is to make sure the data is correct and proceed as usually.")
                            </li>
                        </ul><br>
                        @lang("Donationbox is not responsible for the data exchanged between your payment provider and the recipient. Fundraiser, donor and recipient are responsible for the information they provide.")<br><br>
                        @lang("DonationBox code is publicly available in the Github repository:") <a
                            href="https://github.com/fifle/donationbox" class="no-underline hover:underline
                            text-blue-800" target="_blank">https://github.com/fifle/donationbox</a>
                        </p>
                @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    bankDetails
                @endslot
                @slot('cardTitle')
                        @lang("Why is it important to keep payment details serious and clear?")
                    @endslot
                @slot('cardContent')
                        @lang("According to various international regulations, banks in {{$cc}} and other countries are obliged to monitor payments in real time and ensure that no suspicious transactions pass through them. Otherwise, the bank has the right to freeze funds for transfer from your bank account until the investigation is completed. Therefore, be honest and state the real purpose for the transfer in the explanation.") <br><br>
                        <a href="https://arileht.delfi
                        .ee/artikkel/92451593/lisasid-makseselgitusse-midagi-kahtlast-ole-valmis-et-pank-votab-sinuga
                        -uhendust" class="no-underline hover:underline
                            text-blue-800">@lang("Read more about this on Delfi.ee (in Estonian)")</a>
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    sebUID
                @endslot
                @slot('cardTitle')
                        @lang("What is SEB UID token? How do I get it?")
                    @endslot
                @slot('cardContent')
                        @lang("The UID token is necessary for initiating payments in SEB's online bank. This way SEB improves the security of pre-filled forms on the payment transfer pages.")<br><br>
                        @lang("UID can be received by both individuals and legal entities. Please note that the person representing a legal entity must be a member of the board. To get the UID, you need to send a free-form application with a request for UID to the email:") <a
                            href="mailto:eservice@seb.ee" class="no-underline hover:underline
                            text-blue-800" target="_blank">eservice@seb.ee</a><br><br>
                        <i>@lang("Obtaining a UID does not require you to open an account or sign a contract with SEB.")</i>
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    donorbox
                @endslot
                @slot('cardTitle')
                        @lang("What is Donorbox and how can I find my campaign slug?")
                    @endslot
                @slot('cardContent')
                        @lang("Donorbox is an international online donation platform for non-profits. It allows you to start receiving donations for international payments systems. Donorbox integrates with payment processing platform Stripe, which allows automatically receive money directly to {{$cc}}n IBAN bank account. Also, Donorbox allows you to make anonymous, recurring payments, connect CRM systems to process donor data, etc.")<br><br>
                        @lang("In order to connect Donorbox, you need to register your account. You can do this here:")
                        <a href="https://donorbox.org/orgs/new" class="no-underline hover:underline
                            text-blue-800" target="_blank">https://donorbox.org/orgs/new</a>. @lang("After that, you will need to create a new campaign through the dashboard.")<br><br>
                        @lang("After, open campaign page in Preview mode and pay attention to the page address. Anything after the \"/\" (slash) symbol is a campaign slug. Copy it and place it while creating a new form on DonationBox.")<br><br>
                        @lang("Example: https://donorbox.org/your-slug")
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    paypal
                @endslot
                @slot('cardTitle')
                        @lang("What is Paypal and how do I find my paypal.me username?")
                    @endslot
                @slot('cardContent')
                        @lang("PayPal provides an easy and quick way to send and request money online. Payments can be sent from one Paypal account to another, as well as by using credit card payment. You can register Paypal account here:") <a href="https://www.paypal.com/ee/webapps/mpp/account-selection" class="no-underline hover:underline
                            text-blue-800" target="_blank">https://www.paypal.com/ee/webapps/mpp/account-selection</a><br><br>
                        @lang("Once you have Paypal account, you can generate your page to accept payments on Paypal.me. You can read more about creating your own Paypal.me page here:") <a href="https://www.paypal
                        .com/ee/webapps/mpp/account-selection" class="no-underline hover:underline
                            text-blue-800" target="_blank">https://www.paypal.com/paypalme/</a><br><br>
                        @lang("You can find out your username from generated Paypal.me link. Copy it and place it while creating a new form on DonationBox.")<br><br>
                        @lang("Example: https://paypal.me/username")
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    revolut
                @endslot
                @slot('cardTitle')
                        @lang("What is Revolut? How can I find my Revolut.me link?")
                    @endslot
                @slot('cardContent')
                        @lang("Revolut is a European virtual bank that allows to open your own IBAN bank account for private and corporate clients. You can read more about the service and registration at") <a
                            href="https://www.revolut.com." class="no-underline hover:underline text-blue-800"
                            target="_blank">https://www.revolut.com</a>.<br><br>
                        @lang("If you already have a registered Revolut account, you can generate your Revolut.me link. It will allow to accept payments from donors who don't have Revolut via credit card payments.")<br><br>
                        @lang("To start using Revolut with DonationBox, follow these instructions:"):
                    <ul class="list-decimal ml-6">
                        <li>
                            @lang("Open the Revolut app")
                        </li>
                        <li>
                            @lang("Click on the circle with your name's initials, which is in the upper left corner.")
                        </li>
                        <li>
                            @lang("Under your own name you will see blue text indicating your Revolut username (@username).")
                        </li>
                        <li>
                            @lang("Copy the username and enter it when you create a new DonationBox.")
                        </li>
                    </ul>
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    estBanks
                @endslot
                @slot('cardTitle')
                        @lang("Which banks operating in the Baltics are currently supported?")
                @endslot
                @slot('cardContent')
                        @lang("DonationBox is available for Swedbank (EE, LV, LT), SEB (EE, LV, LT), LHV (EE), Coop (EE). All of them support one-time and recurring payments. We hope that this list may be expanded in the future.")
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    fraud
                @endslot
                @slot('cardTitle')
                        @lang("I see that fraudsters are using the service or spreading false information. What should I do?")
                @endslot
                @slot('cardContent')
                        @lang("Click the \"Report fraud\" button at the bottom of the page or email us at") <a
                            href="mailto:donationbox.{{$cc_domain}}@gmail.com" class="no-underline hover:underline
                            text-blue-800" target="_blank">donationbox.{{$cc_domain}}@gmail.com</a>. @lang("Provide a link to the donation box that seems suspicious to you and specify in the message what exactly confuses you. For our part, we will do our best to respond to your request as soon as possible. When checking, we rely on the opening of data on the company or individual. If a violation is detected, the link may be blocked.")
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    widget
                @endslot
                @slot('cardTitle')
                        @lang("I want to put a donation form widget on my website. How can I do this?")
                    @endslot
                @slot('cardContent')
                        @lang("Each DonationBox page has a field with a code for an automatically generated widget. Copy this code and paste it into the HTML code of your page.")<br><br>
                        @lang("Read more about how you can add code to a page using Wordpress as an example here:"):
                        <a href="https://wordpress.com/support/wordpress-editor/blocks/custom-html-block/" class="no-underline hover:underline
                            text-blue-800" target="_blank">https://wordpress.com/support/wordpress-editor/blocks/custom-html-block/</a>
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    foreignIBAN
                @endslot
                @slot('cardTitle')
                        @lang("Can payee use a foreign IBAN account number?")
                    @endslot
                @slot('cardContent')
                        @lang("Currently the service works only with local IBAN accounts. In the near future the logic for European payments through {{$cc}}n banks will be finalized.")
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    withoutEstBanks
                @endslot
                @slot('cardTitle')
                        @lang("Can I use DonationBox only for Revolut, Donorbox and Paypal?")
                    @endslot
                @slot('cardContent')
                        @lang("Yes, it is possible. Just leave the IBAN field blank and the selection with {{$cc}}n banks will not appear on the donation form.")
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    paymentTypeDiff
                @endslot
                @slot('cardTitle')
                        @lang("What is the difference between a one-time donation and a regular donation? Where is this configured?")
                    @endslot
                @slot('cardContent')
                        @lang("You can choose between these two payment types for bank methods except Revolut and Paypal. You can set the regular donation interval on your bank's payment transfer page.")
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    editForm
                @endslot
                @slot('cardTitle')
                        @lang("Can I change the data in an existing form?")
                    @endslot
                @slot('cardContent')
                        @lang("Yes. Just change the value of the parameter in the URL, open the webpage and copy the newly generated URL.")
                @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    bugs
                @endslot
                @slot('cardTitle')
                        @lang("I found a bug or other inaccuracy. Where do I report it?")
                    @endslot
                @slot('cardContent')
                        @lang("Email us at") <a
                            href="mailto:donationbox.{{$cc_domain}}@gmail.com" class="no-underline hover:underline
                            text-blue-800" target="_blank">donationbox.{{$cc_domain}}@gmail.com</a>. @lang("Specify the address where the problem was found and briefly describe it. Thank you for your contribution to the project!")
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    payeeBg
                @endslot
                @slot('cardTitle')
                        @lang("What does the \"Check payee's background\" link mean?")
                @endslot
                @slot('cardContent')
                        @lang("This link leads to Teatmik.ee or Lursoft.lv services, which collects information about known reports of companies, organizations, as well as individuals and their participation in the boards or ownership of companies. This is an additional method that was created for security purposes to combat fraudsters.")<br><br>
                        @lang("We recommend that you check your organization's information before sending money and be aware of the responsibility of transferring funds to third parties.")
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    anonymous
                @endslot
                @slot('cardTitle')
                        @lang("Can I remain anonymous when making a payment?")
                    @endslot
                @slot('cardContent')
                        @lang("Shortly, no, if you donate through local banks, Revolut or Paypal.")<br><br>

                        @lang("Your name as well as bank details such as IBAN account can be seen by the recipient of the funds. In fact, this is the same as would be the case with a manual direct transfer of funds through your online bank.")<br><br>

                        @lang("Currently, the only method to connect anonymous payments is to use the Donorbox.org service that you can also connect to DonationBox. You can read more about anonymous donations at Donorbox.org FAQ page:"): <a
                            href="https://donorbox.zendesk.com/hc/en-us/articles/360020559851-How-do-I-enable-anonymous-donations- " class="no-underline hover:underline
                            text-blue-800" target="_blank">https://donorbox.zendesk.com/hc/en-us/articles/360020559851-How-do-I-enable-anonymous-donations- </a>
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    needHelp
                @endslot
                @slot('cardTitle')
                        @lang("I need help creating my DonationBox. Who can I contact?")
                    @endslot
                @slot('cardContent')
                        @lang("Please write us to") <a
                            href="mailto:donationbox.{{$cc_domain}}@gmail.com" class="no-underline hover:underline
                            text-blue-800" target="_blank">donationbox.{{$cc_domain}}@gmail.com</a>. @lang("We will be happy to help you set up all the integrations with payment systems, design your page at donationbox.ee, and add our widget to your website.")
                    @endslot
            @endcomponent
        </div>

        @include('footer')
    </div>

</div>
</div>

</div>

<script>
    function app() {
        return {
            step: 1,
        }
    }
</script>
</body>
</html>
