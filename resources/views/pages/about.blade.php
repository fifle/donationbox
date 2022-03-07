<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head')
</head>
<body class="antialiased">

<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl w-full space-y-2">
        <div class="items-center justify-center mt-8 mb-6">
            <div class="w-1/3 mx-auto mb-4">
                <a href="/">
                    <img class="mx-auto" src="/img/db-logo-fl.png">
                </a>
            </div>
            <h1 class="text-center text-3xl text-gray-700 mb-8">
                FAQ
            </h1>

            @component('components.faq-card')
                @slot('cardName')
                    whatIsDonationBox
                @endslot
                @slot('cardTitle')
                    What is a DonationBox?
                @endslot
                @slot('cardContent')
                    <p>This is a web application for generating links to direct or regular donation forms for
                        Estonian and international banks. The app allows you to create your own virtual donation box
                        for donations without having to write code or link your website or app to contracts and
                        integrations with banklink.</p> <br> <p>
                        We provide a convenient interface for donors so that they don't have to enter data manually
                        or copy it. The donor only has to follow a link by scanning a QR-code or going to a
                        direct URL-address, enter the amount of donation, choose the transfer type - one-time or regular payment (single or standing order), and choose your bank, Paypal or credit card payment type.</p>
                @endslot
            @endcomponent

            @component('components.faq-card')
                @slot('cardName')
                    free
                @endslot
                @slot('cardTitle')
                    Why is DonationBox free?
                @endslot
                @slot('cardContent')
                    <p>
                        Currently connecting solutions related to accepting donations is either quite difficult for a
                        person who does not have technical skills, or has a monthly fee, which may be inappropriate
                        in cases where the collection is organized by a private person or an NGO that does not have
                        regular donors.<br><br>
                        We believe it is important to make organizing fundraisers in Estonia a quick, convenient,
                        and, most importantly, fee free method for fundraisers.
                    </p>
                @endslot
            @endcomponent

            @component('components.faq-card')
                @slot('cardName')
                    security
                @endslot
                @slot('cardTitle')
                        Is this website secure? It's not phishing?
                @endslot
                @slot('cardContent')
                    <p>
                        In short: Yes, it's safe.<br><br>

                        DonationBox is just an intermediary that sends a request to your bank's web page with the
                        account number, the name of the recipient, an explanation, and the amount of the payment. The
                        bank chosen by the user is responsible for the security of the transfer and all actions
                        related to user authentication.<br><br>

                        We, according to all modern standards, use a secure SSL connection, but we advise you to use
                        additional data encryption tools such as incognito mode, VPN, etc. for anonymity.
                    </p>
                @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    checkYourBank
                @endslot
                @slot('cardTitle')
                        How do you check that you really got to your bank's website and not some fake page asking for banking information?
                    @endslot
                @slot('cardContent')
                    <p>
                        <p><span style="font-weight: 400;">After selecting your banking method, you may want to pay attention to the URL of the web page to which you were redirected when you click. To do this, open the address bar of the browser window with the bank's website and note that it matches the following domains and is listed by your browser as a </span><em><span style="font-weight: 400;">Secure</span></em><span style="font-weight: 400;"> website (in this case, Chrome, Safari and Firefox will show a closed padlock icon next to the address).</span></p>
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
                        Okay, but how do you protect and store my data? Will my transactions be able to be seen by
                        someone else?
                    @endslot
                @slot('cardContent')
                    <p>
                        In short, we do our best to make sure that no one but only you, your bank, and payee knows
                        about your transfer. To do this, DonationBox is arranged as follows:<br> <br>

                        <ul class="list-decimal ml-6 break-words">
                            <li>We don't store your data in a database. Instead, we generate a special link for you that
                                already contains all the data related to the campaign. The parameters from this link
                                are read by the DonationBox application, which displays the donation form. The link
                                includes the campaign name, payment detail, payee's name, IBAN bank account number,
                                your Revolut.me username, your Paypal.me username, slug for your Donorbox campaign,
                                your UID from SEB. You can check this by changing any value in the URL link and
                                paying attention to the changes in the data displayed on the donations page
                                .<br><br>
                                <b>Example link with parameters:</b> <a href="https://donationbox
                                .ee/donation?campaign_title=Donate+Estonian+Jewish+Museum&detail=Annetus&payee=Eesti
                                    +Juudi+Muuseum+MT%C3%9C&iban=EE312200221037561773&pp=&db=support-estonian-jewish
                                    -museum&sebuid=f0233a8a-2c62-414d-a8e0-868d5ca345cb" class="no-underline hover:underline text-blue-800">https://donationbox
                                .ee/donation?campaign_title=Donate+Estonian+Jewish+Museum&detail=Annetus&payee=Eesti
                                    +Juudi+Muuseum+MT%C3%9C&iban=EE312200221037561773&pp=&db=support-estonian-jewish
                                    -museum&sebuid=f0233a8a-2c62-414d-a8e0-868d5ca345cb</a><br><br>
                            </li>
                            <li>We only redirect you to the bank's page, where after authentication you will be waiting for the pre-filled with the data for the transfer. All you have to do is make sure the data is correct and make the payment the same way you would do it if you entered all the data into the form manually. To do this we use the parameter transfer method supported by Estonian online banks. For example, the link to start a new payment for Swedbank would look like this:
                                <a href="https://www.swedbank.ee/private/d2d/payments2/domestic/new?payment
                                .beneficiaryAccountNumber=EE312200221037561773&payment
                                    .beneficiaryName=Eesti%20Juudi%20Muuseum%20MT%C3%9C&payment
                                    .details=Annetus&payment.amount=5" class="no-underline hover:underline text-blue-800">https://www.swedbank.ee/private/d2d/payments2/domestic/new?payment
                                .beneficiaryAccountNumber=EE312200221037561773&payment
                                    .beneficiaryName=Eesti%20Juudi%20Muuseum%20MT%C3%9C&payment
                                    .details=Annetus&payment.amount=5</a><br><br>
                            </li>
                            <li>You also have the opportunity to correct the data in the payment form on your
                                internet-bank webpage. This is the key difference from the banklink, which creates a
                                request to the bank on payment initiation, where the amount and other bank data are
                                already specified, which are not subject to any changes on the bank's website.<br><br>
                                This is done so that after the client confirms the payment, you can get confirmation from the bank that the transaction has taken place and record in the database of your own service (online store, portal, etc.). DonationBox transmits the data through the parameters in the URL, without the need for a response back from the bank's server. You won't be redirected back to DonationBox after finishing the payment.
                            </li>
                        </ul><br>
                        Donationbox is not responsible for the use of your bank information, name and other
                        information by third parties. When you create a donation box and share a link to it, it is
                        your responsibility to evaluate the risks of making this information available on the
                        Internet.<br><br>
                        Also, the DonationBox code is publicly available in the repository on Github: <a
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
                        Why is it important for the bank transfer details to be serious and clear in content?
                    @endslot
                @slot('cardContent')
                        A transfer detail (reference) is essentially your official explanation to the bank as to why
                        you want to transfer money to a particular individual or legal entity. According to various
                        international regulations, banks in Estonia and other countries are obliged to monitor
                        payments in real time and ensure that no suspicious transactions pass through them.
                        Otherwise, the bank has the right to freeze funds for transfer from your bank account until
                        the investigation is completed. Therefore, be honest and state the real purpose for the
                        transfer in the explanation. <br><br>
                        <a href="https://arileht.delfi
                        .ee/artikkel/92451593/lisasid-makseselgitusse-midagi-kahtlast-ole-valmis-et-pank-votab-sinuga
                        -uhendust" class="no-underline hover:underline
                            text-blue-800">Read more about this in the article on Delfi.ee. </a>
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    sebUID
                @endslot
                @slot('cardTitle')
                        What is the UID identifier that I need to connect payments via SEB bank? How do I get it?
                    @endslot
                @slot('cardContent')
                        The UID identifier is necessary for initiating payments in SEB's online bank. In this way SEB
                        makes sure in advance that the payee is going to receive payments using a direct bank link
                        generated by DonationBox.<br><br>
                        UID numbers can be received by both individuals and legal entities. Please note that a person
                        representing a legal entity should be a member of the board of a company or a non-profit
                        organization. To do this, you need to make a free-form application with a request for UID to
                        the email of the bank: <a href="mailto:eservice@seb.ee" class="no-underline hover:underline
                            text-blue-800" target="_blank">eservice@seb.ee</a><br><br>
                        <b>Obtaining a UID does not require you to open an account or sign a contract with SEB.</b>
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    donorbox
                @endslot
                @slot('cardTitle')
                        What is Donorbox and how do I find my campaign slug?
                    @endslot
                @slot('cardContent')
                        Donorbox is an international online donation platform for all nonprofit organizations. It
                        allows you to start receiving donations for international payments systems. Donorbox
                        integrates with online payment processing platform Stripe, which allows you to connect and
                        automatically receive money from transactions to your Estonian IBAN bank account. Also,
                        Donorbox allows you to make anonymous, recurring payments, connect CRM systems to process
                        donor data, etc.<br><br>
                        First of all, you need to register your Donorbox account. You can do this here:
                        <a href="https://donorbox.org/orgs/new" class="no-underline hover:underline
                            text-blue-800" target="_blank">https://donorbox.org/orgs/new</a>. After that,
                        you will need to create a new campaign.<br><br>
                        After generating the campaign page, open it in Preview mode and pay attention to the page
                        address. Anything after the "/" symbol is a campaign slug. Copy it and place it to the
                        DonationBox creation form.<br><br>
                        Example: https://donorbox.org/your-slug
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    paypal
                @endslot
                @slot('cardTitle')
                        What is Paypal and how do I find my paypal.me username?
                    @endslot
                @slot('cardContent')
                        PayPal provides an easy and quick way to send and request money online. Payments in this
                        system can be sent from one Paypal account to another, as well as by credit card payment. You
                        can register a Paypal account here: <a href="https://www.paypal.com/ee/webapps/mpp/account-selection" class="no-underline hover:underline
                            text-blue-800" target="_blank">https://www.paypal.com/ee/webapps/mpp/account-selection</a><br><br>
                        Once you have a Paypal account, you can generate your page to accept payments on Paypal.me.
                        You can read more about creating a link and about Paypal.me here: <a href="https://www.paypal.com/ee/webapps/mpp/account-selection" class="no-underline hover:underline
                            text-blue-800" target="_blank">https://www.paypal.com/paypalme/</a><br><br>
                        Anything in your Paypal.me link address after the "/" symbol is your username. Copy it and
                        place it to the DonationBox creation form.<br><br>
                        Example: https://paypal.me/username
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    revolut
                @endslot
                @slot('cardTitle')
                        What is Revolut and how do I find my Revolut.me link?
                    @endslot
                @slot('cardContent')
                        Revolut is a virtual bank that offers customers a prepaid debit card for chip, contactless
                        and online payments and ATM withdrawals at home and abroad. Revolut allows you to open your
                        own IBAN bank account. You can read more about the service and registration at <a
                            href="https://www.revolut.com." class="no-underline hover:underline text-blue-800"
                            target="_blank">https://www.revolut.com</a>.<br><br>
                        If you already have a registered Revolut account, you can generate your Revolut.me link,
                        which will allow you to accept payments from donors who don't have Revolut via credit card
                        payments.<br><br>
                        To get Revolut for DonationBox, follow these instructions:
                    <ul class="list-decimal ml-6">
                        <li>
                            Open the Revolut app
                        </li>
                        <li>
                            Click on the circle with your name's initials, which is in the upper left corner.
                        </li>
                        <li>
                            Under your own name you will see blue text indicating your Revolut username (for example, @username).
                        </li>
                        <li>
                            Copy this username and specify it while creating a DonationBox.
                        </li>
                    </ul>
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    estBanks
                @endslot
                @slot('cardTitle')
                        Which Estonian banks does the app work with?
                @endslot
                @slot('cardContent')
                        At the moment we have links available for the following banks: Swedbank, SEB, LHV, Coop. All of them support one-time and recurring payments. We hope that this list may be expanded in the future.
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    fraud
                @endslot
                @slot('cardTitle')
                        I see that fraudsters are using the service or spreading false information. What should I do?
                @endslot
                @slot('cardContent')
                        Click the "Report fraud" button at the bottom of the page or email us at <a
                            href="mailto:hello@donationbox.ee" class="no-underline hover:underline
                            text-blue-800" target="_blank">hello@donationbox.ee</a>. Provide a link to the
                        donation
                            box that seems suspicious to you and specify in the message what exactly confuses you. For our part, we will do our best to respond to your request as soon as possible. When checking, we rely on the opening of data on the company or individual. If a violation is detected, the link may be blocked.
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    widget
                @endslot
                @slot('cardTitle')
                        I want to put a donation form (widget) on my website. How can I do this?
                    @endslot
                @slot('cardContent')
                        On every donation box page there is a box with the code of an automatically generated widget.
                        Copy this code and paste it into the HTML code of your page.<br><br>
                        Read more about how you can add code to a page using Wordpress as an example here:
                        <a href="https://wordpress.com/support/wordpress-editor/blocks/custom-html-block/" class="no-underline hover:underline
                            text-blue-800" target="_blank">https://wordpress.com/support/wordpress-editor/blocks/custom-html-block/</a>
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    foreignIBAN
                @endslot
                @slot('cardTitle')
                        Can payee use a foreign IBAN account number?
                    @endslot
                @slot('cardContent')
                        Currently the service works only with Estonian IBAN accounts. In the near future the logic for European payments through Estonian banks will be finalized.
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    withoutEstBanks
                @endslot
                @slot('cardTitle')
                        Can I use DonationBox only for Revolut, Donorbox and Paypal?
                    @endslot
                @slot('cardContent')
                        Yes, it is possible. Just leave the IBAN field blank and the selection with Estonian banks will not appear on the donation form.
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    paymentTypeDiff
                @endslot
                @slot('cardTitle')
                        What is the difference between a one-time donation and a regular donation? Where is this configured?
                    @endslot
                @slot('cardContent')
                        You can choose between these two payment types for bank methods except Revolut and Paypal. You can set the regular donation interval on your bank's payment transfer page.
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    editForm
                @endslot
                @slot('cardTitle')
                        Can I change the data in an existing form?
                    @endslot
                @slot('cardContent')
                        Yes. Just change the value of the parameter in the URL, open the webpage and copy the newly generated URL.
                @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    bugs
                @endslot
                @slot('cardTitle')
                        I found a bug or other inaccuracy. Where do I report it?
                    @endslot
                @slot('cardContent')
                        Email us at <a
                            href="mailto:hello@donationbox.ee" class="no-underline hover:underline
                            text-blue-800" target="_blank">hello@donationbox.ee</a>. Specify the address where the problem was found and briefly describe it. Thank you for your contribution to the project!
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    payeeBg
                @endslot
                @slot('cardTitle')
                        What does the "Check payee's background" link mean?
                @endslot
                @slot('cardContent')
                        This link leads to Teatmik.ee service, which collects information about known reports of
                        companies, organizations, as well as individuals and their participation in the boards or
                        ownership of companies. This is an additional method that was created for security purposes
                        to combat fraudsters.<br><br>
                        We recommend that you check your organization's information before sending money and be aware of the responsibility of transferring funds to third parties.
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    anonymous
                @endslot
                @slot('cardTitle')
                        Can I remain anonymous when making a payment?
                    @endslot
                @slot('cardContent')
                        The method for working with Estonian bank systems, Revolut and Paypal, which we use at
                        DonationBox, does not allow you to remain anonymous when transferring funds. Your name as
                        well as bank details such as IBAN account can be seen by the recipient of the funds. In fact,
                        this is the same as would be the case with a manual direct transfer of funds through your
                        online bank.<br><br>

                        The only method to connect anonymous payments is to use the Donorbox service, which you can
                        also connect to your DonationBox page. You can read more about it here: <a
                            href="https://donorbox.zendesk.com/hc/en-us/articles/360020559851-How-do-I-enable-anonymous-donations- " class="no-underline hover:underline
                            text-blue-800" target="_blank">https://donorbox.zendesk.com/hc/en-us/articles/360020559851-How-do-I-enable-anonymous-donations- </a>
                    @endslot
            @endcomponent
            @component('components.faq-card')
                @slot('cardName')
                    needHelp
                @endslot
                @slot('cardTitle')
                        I need help creating my DonationBox. Who can I contact?
                    @endslot
                @slot('cardContent')
                        Please write us to <a
                            href="mailto:hello@donationbox.ee" class="no-underline hover:underline
                            text-blue-800" target="_blank">hello@donationbox.ee</a>. We will be happy to help you set up all the integrations with payment systems, design your page at donationbox.ee, and add our widget to your website.
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