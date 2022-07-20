@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Add new branch
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.branches.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">Branch Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" placeholder="Write Name" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="address">Branch Address</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" placeholder="Write address" required>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="bays_jacks">Number of buys/jacks</label>
                <input class="form-control {{ $errors->has('bays_jacks') ? 'is-invalid' : '' }}" type="number" name="bays_jacks" id="bays_jacks" value="{{ old('bays_jacks', '') }}" step="1" placeholder="Write number" required>
                @if($errors->has('bays_jacks'))
                    <span class="text-danger">{{ $errors->first('bays_jacks') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required">Booking capability</label>
                <select class="form-control {{ $errors->has('booking_capability') ? 'is-invalid' : '' }}" name="booking_capability" id="booking_capability" required>
                    <option value disabled {{ old('booking_capability', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Branch::BOOKING_CAPABILITY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('booking_capability', 'both_online_and_walk_in') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('booking_capability'))
                    <span class="text-danger">{{ $errors->first('booking_capability') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required">Status</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Branch::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'active') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
            </div>

            <label><h4>Branch operational hour &  car acceptance number</h3></label>
            <div class="branch_timing">
                <div class="branch_row">
                    <div class="form-group switchbtn">
                        <div>
                            <label for="">Monday</label>
                        </div>
                        <label class="switch">
                            <input type="checkbox" class="open_closed_monday active" name="switchbtn[]" value="on" checked>
                            <span class="slider round"></span>
                            <input type="text" name="radio_hidden" id="radio_hidden" class="radio_hidden" value="on">
                        </label><span class="switch_open_close">open</span>
                    </div>
                    <div class="if_branch_closed">
                        <div class="form-group start_time">
                            <input type="time" name="start_time[]" id="start_time" class="form-control"  min="1" max="24" required>
                        </div>
                        <div class="form-group">
                            <p>-</p>
                        </div>
                        <div class="form-group end_time">
                            <input type="time" name="end_time[]" id="end_time" class="form-control" min="1" max="24" required>
                        </div>
                        <div class="form-group cars">
                            <input type="number" name="cars[]" id="cars" class="form-control" min="1">
                            <input type="text" name="cars" id="cars" class="form-control" placeholder="cars" disabled>
                        </div>
                        <div class="form-group">
                            <p>Per</p>
                        </div>
                        <div class="form-group hours">
                            <input type="number" name="hours[]" id="hours" class="form-control" min="1" required>
                            <input type="text" name="hours" id="hours" class="form-control" placeholder="hours" disabled>
                        </div>
                    </div>
                </div>
            


                <div class="branch_row">
                    <div class="form-group switchbtn">
                        <div>
                            <label for="">Tuesday</label>
                        </div>
                        <label class="switch">
                            <input type="checkbox" class="open_closed_tuesday active" name="switchbtn[]" value="on" checked>
                            <span class="slider round"></span>
                        </label><span class="switch_open_close">open</span>
                    </div>
                    <div class="if_branch_closed">
                        <div class="form-group start_time">
                            <input type="time" name="start_time[]" id="start_time" class="form-control"  min="1" max="24" required>
                        </div>
                        <div class="form-group">
                            <p>-</p>
                        </div>
                        <div class="form-group end_time">
                            <input type="time" name="end_time[]" id="end_time" class="form-control" min="1" max="24" required>
                        </div>
                        <div class="form-group cars">
                            <input type="number" name="cars[]" id="cars" class="form-control" min="1">
                            <input type="text" name="cars" id="cars" class="form-control" placeholder="cars" disabled>
                        </div>
                        <div class="form-group">
                            <p>Per</p>
                        </div>
                        <div class="form-group hours">
                            <input type="number" name="hours[]" id="hours" class="form-control" min="1" required>
                            <input type="text" name="hours" id="hours" class="form-control" placeholder="hours" disabled>
                        </div>
                    </div>
                </div>


                <div class="branch_row">
                    <div class="form-group switchbtn">
                        <div>
                            <label for="">Wednesday</label>
                        </div>
                        <label class="switch">
                            <input type="checkbox" class="open_closed_wednesday active" name="switchbtn[]" value="on" checked>
                            <span class="slider round"></span>
                        </label><span class="switch_open_close">open</span>
                    </div>
                    <div class="if_branch_closed">
                        <div class="form-group start_time">
                            <input type="time" name="start_time[]" id="start_time" class="form-control"  min="1" max="24" required>
                        </div>
                        <div class="form-group">
                            <p>-</p>
                        </div>
                        <div class="form-group end_time">
                            <input type="time" name="end_time[]" id="end_time" class="form-control" min="1" max="24" required>
                        </div>
                        <div class="form-group cars">
                            <input type="number" name="cars[]" id="cars" class="form-control" min="1">
                            <input type="text" name="cars" id="cars" class="form-control" placeholder="cars" disabled>
                        </div>
                        <div class="form-group">
                            <p>Per</p>
                        </div>
                        <div class="form-group hours">
                            <input type="number" name="hours[]" id="hours" class="form-control" min="1" required>
                            <input type="text" name="hours" id="hours" class="form-control" placeholder="hours" disabled>
                        </div>
                    </div>
                </div>



                <div class="branch_row">
                    <div class="form-group switchbtn">
                        <div>
                            <label for="">Thursday</label>
                        </div>
                        <label class="switch">
                            <input type="checkbox" class="open_closed_thursday active" name="switchbtn[]" value="on" checked>
                            <span class="slider round"></span>
                        </label><span class="switch_open_close">open</span>
                    </div>
                    <div class="if_branch_closed">
                        <div class="form-group start_time">
                            <input type="time" name="start_time[]" id="start_time" class="form-control"  min="1" max="24" required>
                        </div>
                        <div class="form-group">
                            <p>-</p>
                        </div>
                        <div class="form-group end_time">
                            <input type="time" name="end_time[]" id="end_time" class="form-control" min="1" max="24" required>
                        </div>
                        <div class="form-group cars">
                            <input type="number" name="cars[]" id="cars" class="form-control" min="1">
                            <input type="text" name="cars" id="cars" class="form-control" placeholder="cars" disabled>
                        </div>
                        <div class="form-group">
                            <p>Per</p>
                        </div>
                        <div class="form-group hours">
                            <input type="number" name="hours[]" id="hours" class="form-control" min="1" required>
                            <input type="text" name="hours" id="hours" class="form-control" placeholder="hours" disabled>
                        </div>
                    </div>
                </div>



                <div class="branch_row">
                    <div class="form-group switchbtn">
                        <div>
                            <label for="">Friday</label>
                        </div>
                        <label class="switch">
                            <input type="checkbox" class="open_closed_friday active" name="switchbtn[]" value="on" checked>
                            <span class="slider round"></span>
                        </label><span class="switch_open_close">open</span>
                    </div>
                    <div class="if_branch_closed">
                        <div class="form-group start_time">
                            <input type="time" name="start_time[]" id="start_time" class="form-control"  min="1" max="24" required>
                        </div>
                        <div class="form-group">
                            <p>-</p>
                        </div>
                        <div class="form-group end_time">
                            <input type="time" name="end_time[]" id="end_time" class="form-control" min="1" max="24" required>
                        </div>
                        <div class="form-group cars">
                            <input type="number" name="cars[]" id="cars" class="form-control" min="1">
                            <input type="text" name="cars" id="cars" class="form-control" placeholder="cars" disabled>
                        </div>
                        <div class="form-group">
                            <p>Per</p>
                        </div>
                        <div class="form-group hours">
                            <input type="number" name="hours[]" id="hours" class="form-control" min="1" required>
                            <input type="text" name="hours" id="hours" class="form-control" placeholder="hours" disabled>
                        </div>
                    </div>
                </div>



                <div class="branch_row">
                    <div class="form-group switchbtn">
                        <div>
                            <label for="">Saturday</label>
                        </div>
                        <label class="switch">
                            <input type="checkbox" class="open_closed_saturday active" name="switchbtn[]" value="on" checked>
                            <span class="slider round"></span>
                        </label><span class="switch_open_close">open</span>
                    </div>
                    <div class="if_branch_closed">
                        <div class="form-group start_time">
                            <input type="time" name="start_time[]" id="start_time" class="form-control"  min="1" max="24" required>
                        </div>
                        <div class="form-group">
                            <p>-</p>
                        </div>
                        <div class="form-group end_time">
                            <input type="time" name="end_time[]" id="end_time" class="form-control" min="1" max="24" required>
                        </div>
                        <div class="form-group cars">
                            <input type="number" name="cars[]" id="cars" class="form-control" min="1" required>
                            <input type="text" name="cars" id="cars" class="form-control" placeholder="cars" disabled>
                        </div>
                        <div class="form-group">
                            <p>Per</p>
                        </div>
                        <div class="form-group hours">
                            <input type="number" name="hours[]" id="hours" class="form-control" min="1" required>
                            <input type="text" name="hours" id="hours" class="form-control" placeholder="hours" disabled>
                        </div>
                    </div>
                </div>



                <div class="branch_row">
                    <div class="form-group switchbtn">
                        <div>
                            <label for="">Sunday</label>
                        </div>
                        <label class="switch">
                            <input type="checkbox" class="open_closed_sunday active" name="switchbtn[]" value="on" checked>
                            <input type="text" name="radio_hidden[]" id="radio_hidden" class="radio_hidden" value="on">
                            <span class="slider round"></span>
                        </label><span class="switch_open_close">open</span>
                    </div>
                    <div class="if_branch_closed">
                        <div class="form-group start_time">
                            <input type="time" name="start_time[]" id="start_time" class="form-control"  min="1" max="24" required>
                        </div>
                        <div class="form-group">
                            <p>-</p>
                        </div>
                        <div class="form-group end_time">
                            <input type="time" name="end_time[]" id="end_time" class="form-control" min="1" max="24" required>
                        </div>
                        <div class="form-group cars">
                            <input type="number" name="cars[]" id="cars" class="form-control" min="1">
                            <input type="text" name="cars" id="cars" class="form-control" placeholder="cars" disabled>
                        </div>
                        <div class="form-group">
                            <p>Per</p>
                        </div>
                        <div class="form-group hours">
                            <input type="number" name="hours[]" id="hours" class="form-control" min="1" required>
                            <input type="text" name="hours" id="hours" class="form-control" placeholder="hours" disabled>
                        </div>
                    </div>
                </div>

            </div>




            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    Add branch
                </button>
            </div>
        </form>
    </div>
</div>



@endsection


@section('scripts')
    

<script>
$(document).ready(function() {
    $(".open_closed_monday, .open_closed_tuesday, .open_closed_wednesday, .open_closed_thursday, .open_closed_friday, .open_closed_saturday, .open_closed_sunday").click( function() {
        
        $me = $(this);
        $me.toggleClass('off');
        if($me.is(".off")){
            $(".switch_open_close").text("closed");
            $(this).parent().parent().next().hide();
            $(this).parent().parent().next().children().children().removeAttr("required");
            // $(this).val("off");
            // $(this).next().val("off");
        }else {          
            $(".switch_open_close").text("open");
            $(this).parent().parent().next().show();
            $(this).parent().parent().next().children().children().attr("required", true);
            // $(this).val("on");
            // $(this).next().val("on");
        }
    });         
});





</script>
@endsection