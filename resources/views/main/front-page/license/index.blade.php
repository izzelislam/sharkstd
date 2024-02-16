@extends("main.layouts.app")

@section("content")
<main role="main">
  <div class="wrapper">

      <div class="breadcrumb-wrap">
          <div class="container py-3">
              <div class="row d-flex justify-content-md-between justify-content-sm-center">
                  <div class="col-md-4">
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb mb-0">
                              <li class="breadcrumb-item mr-1 font-weight-bold"><a href="/">Home</a></li>
                              <li class="breadcrumb-item ml-1 font-weight-bold active" aria-current="page">
                                  License
                              </li>
                          </ol>
                      </nav>
                  </div>
              </div>
          </div>
      </div>

      <div class="container">
          <div class="row d-flex align-items-stretch">
            
            @foreach ($licenses as $license)
              <div class="col-md-4 my-3">
                  <div class="card text-center">
                      <div class="card-body">
                          <div class="box-icon bg-info-alt text-info d-flex align-items-center justify-content-center">
                              <i class="las la-tv"></i>
                          </div>
                          <div class="content m-3">
                              <h4 class="title font-weight-bold">{{ $license->name }}</h4>
                              @foreach (explode(",", $license->describtion) as $item)
                                <p class="text-muted">
                                  <i class="las la-check text-success"></i> {{ $item }}
                                </p>
                              @endforeach
                          </div>
                      </div>
                  </div>
              </div>
            @endforeach

          </div>
          <!--end row-->
      </div>
  </div>

  <div class="">
    <section class="cta-big section">
        <div class="container">
            <div class="cta-big-content bg-primary py-5 px-5 rounded text-white position-relative">
                <img alt="bg image" class="bg-image" src="/main/assets/img/bg-3.png">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-lg-8 col-md-7">
                        <h3 class="h1">Can’t find license for your need?</h3>
                        <p class="subtitle">Contac Us, We offer custom licenses for you who are looking for a tailored solution.</p>
                    </div>
                    {{-- <div class="col-lg-3 offset-lg-1 col-md-5 align-self-center">
                        <img src="/main/assets/img/illustrations/03.svg" alt="" class="img-fluid">
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
</div>

<div class="container my-4 border rounded p-4">
  <div class="text-center">
    <h2 class="">You Are Not Allowed To</h2>
  </div>
  <hr>
  <ul>
    <div class="mb-3 text-muted"> <i class="las la-times-circle text-danger me-2"></i>You may not edit, or modify fonts. Convert to paths and editing in programs such as Illustrator are permitted, provided the results are not converted back to font software for redistribution.</div>
    <div class="mb-3 text-muted"> <i class="las la-times-circle text-danger me-2"></i>
      You cannot redistribute fonts because copyright is still with us.
    </div>
    <div class="mb-3 text-muted"> <i class="las la-times-circle text-danger me-2"></i>
      Editing and / or changing the font name is not permitted, this is not an original font creation and does not negate the original license terms. The device can provide special font designs, adaptations and related licenses for all your needs.
    </div>
    <div class="mb-3 text-muted"> <i class="las la-times-circle text-danger me-2"></i>
      Using font elements as the basis for new fonts is not permitted.
    </div>
    <div class="mb-3 text-muted"> <i class="las la-times-circle text-danger me-2"></i>
      If you want the font to be used as part of the campaign, and need other agencies or individuals to use the same font, they must buy their own license from us as the seller and owner of the copyright font. The correct way to do this is to include the retailer’s URL or Device (http://sharkstd.com/) in your material. The retailer list is currently available in the “Fonts Device Information” file.
    </div>
    <div class="mb-3 text-muted"> <i class="las la-times-circle text-danger me-2"></i>
      Respect for copyright – the legal consequences of using non-licensed or adapted fonts can be very expensive and result in the removal of all offensive copies. Poorly adapted fonts are often found to have a number of serious technical and design errors, the most common being missing kerning (contextual letter space), missing characters, bad spaces, incorrect point construction, clash ID fonts and missing counters because of the wrong direction.
    </div>
    <div class="mb-3 text-muted"> <i class="las la-times-circle text-danger me-2"></i>
      More details will be add on the following files once item downloaded.
    </div>
    <div class="mb-3 text-muted"> <i class="las la-times-circle text-danger me-2"></i>
      For more information about extended license, please send message using our contact form
    </div>
    <div class="mb-3 text-muted"> <i class="las la-times-circle text-danger me-2"></i>
      If you use for commercial without buying license before, you will be charged 100 times the standard license price
    </div>
  </ul>
</div>

</main>
@endsection