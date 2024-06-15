@extends('Admin.Layouts.Master')
@section('title','Danh sách dự án')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title text-center">DANH SÁCH DỰ ÁN</h3>
                    {{-- <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ul> --}}
                </div>
                
            </div>
        </div>
        <form action="" method="get">
            <div class="col-auto float-start ms-auto">
                <a href="{{route('quan-tri.du-an.them')}}" class="btn add-btn"><i
                            class="fa fa-plus"></i> Thêm</a>

            </div>
        <div class="row filter-row">
            <div style="margin-right: 1pt" class="float-end ms-auto col-md-3">
                <div class="form-group form-focus">
                    <input name="name" value="{{request('name')}}" type="text" class="form-control floating">
                    <label class="focus-label">Nhập tên dự án</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group custom-select">
                    <select name="leader_id" class="select floating">
                        <option value="" selected>Trưởng dự án</option>
                        @foreach($param['member'] as $item)
                            <option {{request('leader_id') == $item->id ?"selected" :"" }} value="{{$item->id}}">{{$item->user_detail->fullname ?? ""}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-3 col-md-2">
                <button type="submit" class="btn btn-success w-100"> Tìm kiếm </button>
            </div>
        </div>
        </form>
        <div class="row">
            @foreach($param['list'] as $i)
                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown dropdown-action profile-action">
                                <a href="#" class=" dropdown-toggle" data-bs-toggle="dropdown"
                                   aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{route('quan-tri.du-an.sua',$i->id)}}">
                                        <i class="fa fa-pencil m-r-5"></i> Chỉnh sửa</a>
                                    <a class="dropdown-item" href="javascript:{}" onclick="delete_item('{{$i->id}}','{{route('quan-tri.du-an.xoa','')}}')"><i class="fa fa-trash-o m-r-5"></i>
                                        Xóa</a>
                                </div>
                            </div>
                            <h4 class="project-title text-center"><a href="{{route('du-an.chi-tiet',$i->project_url)}}">{{$i->project_name}}</a></h4>

                            <small class="block text-ellipsis m-b-15 text-center ">
                                <ul class="badge badge-success">{{$i->task->where('task_status_id','=',4)->count()}} <span > Hoàn thành</span></ul>
                                <ul class="badge badge-primary">{{$i->task->where('task_status_id','<>',4)->count()}} <span> Đang thực hiện</span></ul>
                                
                                
                            </small>
                            
                            {{-- <p class="text-muted">{{$i->project_description}}
                            </p> --}}
                            <div class="project-members m-b-15">
                                <div>Trưởng dự án :
                                    <ul class="team-members">
                                        <li>
                                            <a href="#" data-bs-toggle="tooltip"
                                               title="{{$i->lead->user_detail->fullname}}"><img alt=""
                                                                                                 src="{{asset($i->lead->avatar??"uploads/avatar/avatar_defaul1.png")}}"></a>
                                        </li>
                                    </ul>
                                </div>
                                
                            </div>
                            <div class="project-members m-b-15">
                                <div>Thành viên :
                                    <ul class="team-members">
                                        @foreach($i->implementer as $ii)
                                            <li>
                                                <a href="#" data-bs-toggle="tooltip"
                                                   title="{{$ii->user->user_detail->fullname}}">
                                                    <img alt=""
                                                         src="{{asset($ii->user->avatar??"uploads/avatar/avatar_defaul1.png")}}">
                                                </a>
                                            </li>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                                
                            </div>
                            <div class="pro-deadline m-b-15">
                                <div class="sub-title">
                                    Ngày bắt đầu: <span class="float-end">{{App\Helper\DateHelper::date($i->date_start)}}</span>
                                </div>
            
                            </div>
                            <div class="pro-deadline m-b-15">
                                <div class="title">
                                    Ngày kết thúc: <span class="float-end">{{App\Helper\DateHelper::date($i->date_end)}}</span>
                                </div>
                                
                            </div>
                            
                           
                            <?php

                            $total = \Carbon\Carbon::parse($i->date_start)->diffInDays($i->date_end);
                            $start = \Carbon\Carbon::parse()->isAfter($i->date_end) ? - \Carbon\Carbon::parse()->diffInDays($i->date_end): \Carbon\Carbon::parse()->diffInDays($i->date_end);

                            //                                dump ($test);
                            $times =100 - round( (( $total - $start )/$total) *100);
                            //                            $times = round() - (/(\Carbon\Carbon::parse($i->date_start)->diffInDays($i->date_end)))*100);
                            //                           dump(\Carbon\Carbon::parse()->diffInDays($i->date_end));
                            //                            $total1 = 100 - $times;
                            //                            $deadline =
                            ?>
                            <p class="m-b-5">Tổng thời gian: <span class="text-sucess float-end">
                                {{-- <span class="{{$times >0 ? 'text-success' :'text-danger'}}  float-end">{{$times}}%</span> --}}

                                ( {{\Carbon\Carbon::parse($i->date_start)->diffInDays($i->date_end)}} Ngày)
                            </p>

                            <p class="m-b-5">Quá hạn: <span class="text-danger float-end">
                                {{-- <span class="{{$times >0 ? 'text-success' :'text-danger'}}  float-end">{{$times}}%</span> --}}

                                ( {{\Carbon\Carbon::parse()->diffInDays($i->date_end)}} Ngày)
                            </p>
                            {{-- <div class="progress progress-xs mb-0 bg-danger">
                                <div class="progress-bar bg-secondary" role="progressbar" data-bs-toggle="tooltip"
                                     title="{{100 - $times}}%"
                                     style="width: {{$times >0 ?100 - $times : 100 }}%"></div>
                            </div> --}}
                            <p class="m-b-5">Tiến độ: <span class="text-success float-end">{{($i->task->where('task_status_id','=',4)->count()/($i->task->count()!=0?$i->task->count():1))*100}}%</span>
                            </p>

                            {{-- <div class="progress progress-xs mb-0">
                                <div class="progress-bar bg-success" role="progressbar" data-bs-toggle="tooltip"
                                     title="{{($i->task->where('task_status_id','=',6)->count()/($i->task->count()!=0?$i->task->count():1))*100}}%"
                                     style="width: {{($i->task->where('task_status_id','=',6)->count()/($i->task->count()!=0?$i->task->count():1))*100}}%"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    {{-- <div id="create_project" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Project</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Project Name</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Client</label>
                                    <select class="select">
                                        <option>Global Technologies</option>
                                        <option>Delta Infotech</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Rate</label>
                                    <input placeholder="$50" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <select class="select">
                                        <option>Hourly</option>
                                        <option>Fixed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Priority</label>
                                    <select class="select">
                                        <option>High</option>
                                        <option>Medium</option>
                                        <option>Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Add Project Leader</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Team Leader</label>
                                    <div class="project-members">
                                        <a href="#" data-bs-toggle="tooltip" title="Jeffery Lalor"
                                           class="avatar">
                                            <img src="/assets/img/profiles/avatar-16.jpg"
                                                 alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Add Team</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Team Members</label>
                                    <div class="project-members">
                                        <a href="#" data-bs-toggle="tooltip" title="John Doe" class="avatar">
                                            <img src="/assets/img/profiles/avatar-16.jpg"
                                                 alt="">
                                        </a>
                                        <a href="#" data-bs-toggle="tooltip" title="Richard Miles"
                                           class="avatar">
                                            <img src="/assets/img/profiles/avatar-09.jpg"
                                                 alt="">
                                        </a>
                                        <a href="#" data-bs-toggle="tooltip" title="John Smith" class="avatar">
                                            <img src="/assets/img/profiles/avatar-10.jpg"
                                                 alt="">
                                        </a>
                                        <a href="#" data-bs-toggle="tooltip" title="Mike Litorus"
                                           class="avatar">
                                            <img src="/assets/img/profiles/avatar-05.jpg"
                                                 alt="">
                                        </a>
                                        <span class="all-team">+2</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="4" class="form-control summernote"
                                      placeholder="Enter your message here"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Upload Files</label>
                            <input class="form-control" type="file">
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="edit_project" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Project</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Project Name</label>
                                    <input class="form-control" value="Project Management" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Client</label>
                                    <select class="select">
                                        <option>Global Technologies</option>
                                        <option>Delta Infotech</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Rate</label>
                                    <input placeholder="$50" class="form-control" value="$5000" type="text">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <select class="select">
                                        <option>Hourly</option>
                                        <option selected>Fixed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Priority</label>
                                    <select class="select">
                                        <option selected>High</option>
                                        <option>Medium</option>
                                        <option>Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Add Project Leader</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Team Leader</label>
                                    <div class="project-members">
                                        <a href="#" data-bs-toggle="tooltip" title="Jeffery Lalor"
                                           class="avatar">
                                            <img src="/assets/img/profiles/avatar-16.jpg"
                                                 alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Add Team</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Team Members</label>
                                    <div class="project-members">
                                        <a href="#" data-bs-toggle="tooltip" title="John Doe" class="avatar">
                                            <img src="/assets/img/profiles/avatar-16.jpg"
                                                 alt="">
                                        </a>
                                        <a href="#" data-bs-toggle="tooltip" title="Richard Miles"
                                           class="avatar">
                                            <img src="/assets/img/profiles/avatar-09.jpg"
                                                 alt="">
                                        </a>
                                        <a href="#" data-bs-toggle="tooltip" title="John Smith" class="avatar">
                                            <img src="/assets/img/profiles/avatar-10.jpg"
                                                 alt="">
                                        </a>
                                        <a href="#" data-bs-toggle="tooltip" title="Mike Litorus"
                                           class="avatar">
                                            <img src="/assets/img/profiles/avatar-05.jpg"
                                                 alt="">
                                        </a>
                                        <span class="all-team">+2</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="4" class="form-control"
                                      placeholder="Enter your message here"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Upload Files</label>
                            <input class="form-control" type="file">
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal custom-modal fade" id="delete_project" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Project</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal"
                                   class="btn btn-primary cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

@endsection
@section('script')
    <script src="{{asset('system/js/main.js')}}"></script>
@endsection
@section('style')
    <style>

    </style>
@endsection
