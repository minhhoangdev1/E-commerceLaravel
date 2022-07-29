<div>
   <div class="container" style="padding:30px 0;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            Thêm Slider mới
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('admin.homeslider')}}" class="btn btn-success pull-right" >Tất cả Silder</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    <form class="form-horizontal" action="" wire:submit.prevent="addSlide">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="">Title</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Title" class="form-control input-md" wire:model="title" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="">Subtitle</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Subtitle" class="form-control input-md" wire:model="subtitle"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="">Price</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Price" class="form-control input-md" wire:model="price"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="">Link</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Link" class="form-control input-md" wire:model="link"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Image</label>
                            <div class="col-md-4">
                                <input type="file"  class="input-file" wire:model="image"/>
                                @if($image)
                                        <img src="{{$image->temporaryUrl()}}" Width="120"/>
                                @endif
                             </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="">Status</label>
                            <div class="col-md-4">
                                <select class="form-control" wire:model="status">
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for=""></label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
   </div>
</div>
