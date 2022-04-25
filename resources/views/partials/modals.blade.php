<div class="modal" id="callbackModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('general.callbackBtn')</h5>
                <p>@lang('general.fillFormText')</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L16 16M16 1L1 16" stroke="#AEAEAE" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('feedback.inline')}}" enctype="multipart/form-data">
                    <input type="text" name="name" class="form-control" required placeholder="@lang('general.namePlaceholder') *"
                           autocomplete="off">
                    <input type="tel" name="phone" class="form-control" required placeholder="@lang('general.phonePlaceholder') *"
                           autocomplete="off">
                    <input type="email" name="email" class="form-control" placeholder="Email"
                           autocomplete="off">
                    <div class="form-group">
                        <textarea name="comment" cols="30" rows="3" placeholder="@lang('general.commentPlaceholder')"></textarea>
                    </div>
                    <div class="submission">
                        <div class="checker">
                            <label class="checkbox-check">
                                <input type="checkbox" name="agreement" checked required>
                                <span class="checkmark"></span>
                                <span>@lang('general.termsAgree') <a href="{{route('page.terms')}}">@lang('general.more')</a></span>
                            </label>
                        </div>
                    </div>
                {{csrf_field()}}
                    {!! htmlFormSnippet() !!}
                    <input type="hidden" class="page-name" name="page" value="">
                    <input type="hidden" name="pageLink" value="{{\Request::url()}}">
                    <button type="submit" class="btn">@lang('general.sendRequestButton')</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="consultationModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('general.getConsultation')</h5>
                <p>@lang('general.fillFormText')</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L16 16M16 1L1 16" stroke="#AEAEAE" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('feedback.inline')}}" enctype="multipart/form-data">
                    <input type="text" name="name" class="form-control" required placeholder="@lang('general.namePlaceholder') *"
                           autocomplete="off">
                    <input type="tel" name="phone" class="form-control" required placeholder="@lang('general.phonePlaceholder') *"
                           autocomplete="off">
                    <input type="email" name="email" class="form-control" placeholder="Email"
                           autocomplete="off">
                    <div class="submission">
                        <div class="checker">
                            <label class="checkbox-check">
                                <input type="checkbox" name="agreement" checked required>
                                <span class="checkmark"></span>
                                <span>@lang('general.termsAgree') <a href="{{route('page.terms')}}">@lang('general.more')</a></span>
                            </label>
                        </div>
                    </div>
                {{csrf_field()}}
                    <input type="hidden" class="page-name" name="page" value="">
                    <input type="hidden" name="pageLink" value="{{\Request::url()}}">
                    <button type="submit" class="btn">@lang('general.sendRequestButton')</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="successModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img src="/images/icons/success.png" alt="Успешно">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L16 16M16 1L1 16" stroke="#AEAEAE" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <h3>@lang('general.thanks')</h3>
                <p>@lang('general.successText')</p>
                <a href="/" class="callback-btn btn-dark">@lang('general.returnHome')</a>
            </div>
        </div>
    </div>
</div>
