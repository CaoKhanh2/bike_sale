@extends('dashboard.layout.content')


@section('main')
    <div class="container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="row clearfix">
                    <div class="col-md-4 col-sm-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <h5 class="h4">Success modal</h5>
                            <a href="" class="btn-block" data-toggle="modal" data-target="#success-modal"
                                type="button">
                                <img src="vendors/images/modal-img3.jpg" alt="modal" />
                            </a>
                            <div class="modal fade" id="success-modal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body text-center font-18">
                                            <h3 class="mb-20">Form Submitted!</h3>
                                            <div class="mb-30 text-center">
                                                <img src="vendors/images/success.png" />
                                            </div>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing
                                            elit, sed do eiusmod
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                Done
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
