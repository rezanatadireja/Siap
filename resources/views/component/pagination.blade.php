@if(!empty($items->firstItem()))
<div class="row">
  <div class="col-sm-6">
    Showing items {{$items->firstItem()}} to {{$items->lastItem()}} out of {{$items->total()}}
  </div>
  <div class="col-sm-6">
      <ul class="pagination justify-content-end">
        @if($items->currentPage() > 1)
        <li class="page-item"><a class="page-link"  href="javascript:;" data-ajax-url="{{$index_route}}?page={{$items->currentPage() - 1}}"><span class="page-link"> Previous</span></a></li>
        @else
        <li class="page-item disabled"><a class="page-link" href="javascript:;"> Previous</a></li>
        @endif
        @for($i=1;$i<=$items->lastPage(); $i++)
          @if($items->currentPage() == $i) 
          <li class="page-item active"><a class="page-link" href="javascript:;">{{$i}}</a></li>
          @else
          <li class="page-item"><a class="page-link" href="javascript:;" data-ajax-url="{{$index_route}}?page={{$i}}">{{$i}}</a></li>
          @endif
        @endfor
        @if($items->currentPage() < $items->lastPage())
        <li class="page-item"><a class="page-link" href="javascript:;" data-ajax-url="{{$index_route}}?page={{$items->currentPage() + 1}}">Next</a></li>
        @else
        <li class="page-item disabled"><a class="page-link" href="javascript:;">Next</a></li>
        @endif
      </ul>
  </div>
</div>
@endif