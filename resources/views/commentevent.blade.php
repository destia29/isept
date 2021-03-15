<!--
<div class="padding70">
  <h4 class="uppercase space30">Comments&nbsp;&nbsp;<span>(3)</span></h4>
  <ul class="comment-list">
    <li>
      <a class="pull-left" href="#"><img class="comment-avatar" src="images/quote/1.jpg" alt="" height="50" width="50"></a>
      <div class="comment-meta">
        <a href="#">John Doe</a>
        <span>
        <em>Feb 17, 2015, at 11:34</em>
        <a href="#" class="button btn-xs reply"><i class="fa fa-comment"></i>&nbsp;Reply</a>
        </span>
      </div>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor sit amet urna nec tempor. Nullam pellentesque in orci in luctus. Sed convallis tempor tellus a faucibus. Suspendisse et quam eu velit commodo tempus.
      </p>
    </li>
    <li class="comment-sub">
      <a class="pull-left" href="#"><img class="comment-avatar" src="images/quote/2.jpg" alt="" height="50" width="50"></a>
      <div class="comment-meta">
        <a href="#">John Doe</a>
        <span>
        <em>March 08, 2015, at 03:34</em>
        <a href="#" class="button btn-xs reply"><i class="fa fa-comment"></i>&nbsp;Reply</a>
        </span>
      </div>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor sit amet urna nec tempor. Nullam pellentesque in orci in luctus. Sed convallis tempor tellus a faucibus. Suspendisse et quam eu velit commodo tempus.
      </p>
    </li>
    <li>
      <a class="pull-left" href="#"><img class="comment-avatar" src="images/quote/1.jpg" alt="" height="50" width="50"></a>
      <div class="comment-meta">
        <a href="#">John Doe</a>
        <span>
        <em>June 11, 2015, at 07:34</em>
        <a href="#" class="button btn-xs reply"><i class="fa fa-comment"></i>&nbsp;Reply</a>
        </span>
      </div>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor sit amet urna nec tempor. Nullam pellentesque in orci in luctus. Sed convallis tempor tellus a faucibus. Suspendisse et quam eu velit commodo tempus.
      </p>
    </li>
  </ul>
</div>
<h4 class="uppercase space30">Leave a comment</h4>
<form method="post" action="#" id="form" role="form" class="form">
  <div class="row">
    <div class="col-md-6 space20">
      <input name="name" id="name" class="input-md form-control" placeholder="Name *" maxlength="100" required="" type="text">
    </div>
    <div class="col-md-6 space20">
      <input name="email" id="email" class="input-md form-control" placeholder="Email *" maxlength="100" required="" type="email">
    </div>
  </div>
  <div class="space20">
    <input name="website" id="website" class="input-md form-control" placeholder="Website" maxlength="100" required="" type="text">
  </div>
  <div class="space20">
    <textarea name="text" id="text" class="input-md form-control" rows="6" placeholder="Comment" maxlength="400"></textarea>
  </div>
  <button type="submit" class="button btn-small">
  Submit Comment
  </button>
</form> -->

<div class="space60"></div>
  <div class="clearfix prevnext">
    @if($prevpage == 0)
    <a href="#" class="left"><i class="fa fa-angle-left"></i>&nbsp;Prev post</a>
    @elseif(empty($prevdetail))

    @else
    <a href="{{ route('event.detail', ['id' => $prevdetail->id]) }}" class="left"><i class="fa fa-angle-left"></i>&nbsp;Prev post</a>
    @endif
    @if($nextdetail != NULL)
    <a href="{{ route('event.detail', ['id' => $nextdetail->id]) }}" class="right">Next post&nbsp;<i class="fa fa-angle-right"></i></a>
    @else
    
    @endif
  </div>
</div>
