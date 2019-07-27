@extends('layouts.app')

@section('meta-info')
<title>Contact Us- Pro Accounting Support 1-844-842-6880</title>
<meta name="keywords"
    content="Contact Us, Contact Pro Accounting Support, Contact QuickBooks Services, Contact Our Number, Reach Us" />
<meta name="description"
    content="If you face any technical error while using QuickBooks Software Contact Us at our QuickBooks Support Phone Number +1(844) 842-6880." />
@endsection

@section('content')
<section id="contact-banner">
    <img src="/images/contact-us.jpg" class="img-fluid" alt="Contact us - Pro Accounting QuickBooks Support" />
</section>

<section id="contact-content" class="section-padding">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>Contact Us</h2>
                <hr class="heading-underline" />
                <p>Pro Accounting Support is right here to assist you out in any type of scenario concerning <strong><a
                            href="https://www.proaccountingsupport.com/quickbooks-software">QuickBooks
                            Software</a></strong>. Our professionals make sure you to assist 24X7 time So, come to us
                    and discuss your issues
                    with additional alternative described below.</p>
                <h2 class="mb-2">Have any Query ?</h2>
                <div>Email: <a href="mailto:support@proaccountingsupport.com"
                        class="grey-text text-darken-2 fw-500">support@proaccountingsupport.com</a></div>
                <div class="mb-4">Call Us: <a href="tel:+18448426880" class="grey-text text-darken-2 fw-500 mr-4">+1
                        (844) 842-6880</a></div>

                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2976.919760085328!2d-93.5966480845631!3d41.74382357923306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xcc35ff4f99041e77!2sPro+Accounting+Support!5e0!3m2!1sen!2sin!4v1557204725982!5m2!1sen!2sin"
                    width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Your Query Our Solution</div>
                    <form action="{{ route('query.store') }}" class="material" method="POST" id="contact-form">
                        @csrf
                        <div class="card-body">
                            <input type="text" class="@error('name') is-invalid @enderror" name="name"
                                placeholder="Name" /> @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <input type="text" name="email" placeholder="E-mail" value="{{ old('email') }}">
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <textarea name="message" placeholder="Message"></textarea> @error('message')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <button class="btn bg-primary text-white mt-2" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
@include('inc.success')
@if (session('success'))
<script>
    $(document).ready(function() {
            $('#successModal').modal('show');
        });
</script>
@endif

<script type="text/javascript" src="{{ asset('js/jquery.material.form.min.js') }}"></script>
<script type="text/javascript">
    $(function(){
		$('form.material').materialForm();
	});

</script>