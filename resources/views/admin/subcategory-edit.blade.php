@extends('layouts.admin')

@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Subcategory infomation</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{route('admin.index')}}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="{{route('admin.subcategories')}}">
                        <div class="text-tiny">Subcategory</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Edit Subcategory</div>
                </li>
            </ul>
        </div>
        <!-- new-category -->
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{route('admin.subcategories.update')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value={{$subcategory->id}} />
                <fieldset class="name">
                    <div class="body-title">Subcategory Name <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Subcategory name" name="name"
                        tabindex="0" value="{{$subcategory->name}}" aria-required="true" required="">
                </fieldset>
                @error('name') <span class="alert-danger text-center">{{$message}}</span> @enderror
                <fieldset class="name">
                    <div class="body-title">Subcategory Slug <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Subcategory Slug" name="slug"
                        tabindex="0" value="{{$subcategory->slug}}" aria-required="true" required="">
                </fieldset>
                @error('slug') <span class="alert-danger text-center">{{$message}}</span> @enderror
                <fieldset class="name">
                    <div class="body-title">Parent Category <span class="tf-color-1">*</span></div>
                    <select class="form-control" name="parent_id" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('parent_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </fieldset>
                @error('parent_id') <span class="alert-danger text-center">{{ $message }}</span> @enderror

                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(function(){
            $("#myfile").on("change", function(e){
                const photoInp = $("#myfile");
                const [file] = this.files;
                if(file)
            {
                $("#imgpreview img").attr('src', URL.createObjectURL(file));
                $("#imgpreview").show();
            }
            });

            $("input[name='name']").on("change", function(){
                $("input[name='slug']").val(StringToSlug($(this).val()));
            });
        });

        function StringToSlug(Text)
        {
            return Text.toLowerCase()
            .replace(/[^\w]+/g,"")
            .replace(/ +/g,"-");
        }
    </script>
@endpush