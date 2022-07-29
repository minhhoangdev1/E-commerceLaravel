<div>
   <div class="container" style="padding:30px 0;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            Cập nhật danh mục
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('admin.categories')}}" class="btn btn-success pull-right" >Tất cả danh mục</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    <form class="form-horizontal" action="" wire:submit.prevent="updatecategory">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="">Tên danh mục</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Tên danh mục" class="form-control input-md" wire:model="name" wire:keyup="generateslug"/>
                                @error('name') <p class="text-danger">{{$message}}</p>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="">Slug</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Slug" class="form-control input-md" wire:model="slug"/>
                                @error('slug') <p class="text-danger">{{$message}}</p>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="">Parent Category</label>
                            <div class="col-md-4">
                                <select class="form-control" wire:model="category_id">
                                    <option value="">None</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for=""></label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
   </div>
</div>

