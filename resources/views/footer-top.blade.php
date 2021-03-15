<!-- FOOTER -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <h4 class="space30">About us</h4>
        <img src="{{asset('images/basic/LCUnilaLogoHome2.png')}}" class="img-responsive space20" width="230" alt=""/>
        <p align="justify">Language Center of Lampung University is one of UPT owned by Unila and has been established through the Decree of the Ministry of Education and Culture of the Republic of Indonesia.</p>
        <p align="justify">LC Unila is a technical implementation unit in learning development and language services.</p>
      </div>
      <div class="col-md-3">
        <h4 class="space30">Recent Events</h4>
        <ul class="f-posts">
            <?php
              $event_1 = App\Model\Event::orderBy('created_at', 'DESC')->limit(3)->get();
              $i=1;
            ?>
            @foreach($event_1 as $data)
              <li>
                <img src="{{ route('image_event', $data->thumbnail) }}" height="40px" width="55px" alt=""/>
                <h5><a href="{{ route('announcement.detail', ['id' => $data->id]) }}">{{ $data->title }}</a></h5>
                <p><i class="fa fa-calendar"></i>&nbsp; {{ date('F d, Y', strtotime($data->release_date)) }}</p>
              </li>
            @endforeach
        </ul>
      </div>
      <div class="col-md-3">
        <h4 class="space30">Contact</h4>
        <ul class="c-info">
          <li><i class="fa fa-map-marker"></i> Jl. Prof. Dr. Sumantri Brojonegoro<br>No. 1 Bandar Lampung<br>35145 - Indonesia</li>
          <li><i class="fa fa-phone"></i> (+62) 721 770 844</li>
          <li><i class="fa fa-envelope-o"></i> uptbahasa@kpa.unila.ac.id</li>
          <li><i class="fa fa-facebook"></i> @balaibahasauniversitaslampung</li>
        </ul>
        <div class="clearfix space10"></div>
      </div>
      <div class="col-md-3">
        <h4 class="space30">Gallery</h4>
        <ul class="thumbs">
          <?php $event = App\Model\Event::select('thumbnail')->limit(9)->get(); ?>
          @foreach($event as $data)
            <li>
              <a target="_blank" href="{{ url('./storage/event_thumbnail/'.$data->thumbnail) }}"><img src="{{ asset('storage/event_thumbnail/'.$data->thumbnail ) }}"></a>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</footer>
