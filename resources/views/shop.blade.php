@extends('layouts.app')
@section('content')
<style>
  
    .heart-outline {
      color: orange;
      fill: orange; 
      stroke: orange; 
    }


    .heart-filled {
     color: #FF1493; /* Deep Pink */
      fill: #FF1493;
      stroke: #FF1493;
    }

</style>

<main class="pt-100">
    <section class="shop-main container d-flex pt-4 pt-xl-5 bg-transparent">
      <div class="shop-sidebar side-sticky " id="shopFilter">
        <div class="aside-header d-flex d-lg-none align-items-center">
          <h3 class="text-uppercase fs-6 mb-0">Filter By</h3>
          <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
        </div>
        <div class="pt-4 pt-lg-0"></div>
        <div class="accordion" id="categoryAccordion">
          <div class="accordion-item mb-4">
            <h5 class="text-uppercase fs-5 mb-3">
                            Product Categories
            @foreach($categories as $category)
              <div class="accordion-item mb-2">
                <h2 class="accordion-header" id="heading-{{ $category->id }}">
                  <button class="accordion-button p-0 border-0 fs-5 text-uppercase collapsed bg-transparent" type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#collapse-{{ $category->id }}"
                          aria-expanded="false"
                          aria-controls="collapse-{{ $category->id }}">
                    {{ $category->name }}
                    <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                      <path
                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                    </g>
                  </svg>
                  </button>
                </h2>
                <div id="collapse-{{ $category->id }}" class="accordion-collapse collapse"
                    aria-labelledby="heading-{{ $category->id }}" data-bs-parent="#categories-list">
                  <div class="accordion-body px-3 pt-1 pb-2">
                    <ul class="list list-inline mb-0">
                      @foreach($subcategories->where('parent_id', $category->id) as $subcategory)
                        <li class="list-item">
                          <span class="menu-link py-1">
                            <input type="checkbox" class="chk-category" name="subcategories" value="{{$subcategory->id}}"
                            @if(in_array($subcategory->id,explode(',',$f_subcategories))) checked="checked" @endif/>
                            {{$subcategory->name}}
                          </span>
                          <span class="text-right float-end">{{$subcategory->products->count()}}</span>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            @endforeach
            </h5> 
          </div>
        </div>

      <div class="accordion" id="price-filters">
          <div class="accordion-item mb-4">
            <h5 class="accordion-header mb-2" id="accordion-heading-price">
              <button class="accordion-button p-0 border-0 fs-5 text-uppercase bg-transparent" type="button" data-bs-toggle="collapse"
                data-bs-target="#accordion-filter-price" aria-expanded="true" aria-controls="accordion-filter-price">
                Harga
                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                  <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                    <path
                      d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                  </g>
                </svg>
              </button>
            </h5>
            <div id="accordion-filter-price" class="accordion-collapse collapse show border-0"
              aria-labelledby="accordion-heading-price" data-bs-parent="#price-filters">
              <input class="price-range-slider" type="text" name="price_range" value="" data-slider-min="1"
                data-slider-max="300000" data-slider-step="5" data-slider-value="[{{$min_price}},{{$max_price}}]" data-currency="Rp" />
              <div class="price-range__info d-flex align-items-center mt-2">
                <div class="me-auto">
                  <span class="text-secondary">Min Price: </span>
                  <span class="price-range__min">Rp10.000</span>
                </div>
                <div>
                  <span class="text-secondary">Max Price: </span>
                  <span class="price-range__max">Rp300.000</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="shop-list flex-grow-1">
        <div class="swiper-container js-swiper-slider slideshow slideshow_small slideshow_split" data-settings='{
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": 1,
            "effect": "fade",
            "loop": true,
            "pagination": {
              "el": ".slideshow-pagination",
              "type": "bullets",
              "clickable": true
            }
          }'>
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="slide-split h-100 d-block d-md-flex overflow-hidden">
                
                <div class="slide-split_media position-relative">
                  <div class="slideshow-bg" style="background-color: #f5e6e0;">
                    <img loading="lazy" src="{{asset('images/bg-menu/shop.jpg')}}"
                      alt="Women's accessories" class="slideshow-bg__img object-fit-cover" />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="container p-3 p-xl-5">
            <div class="slideshow-pagination d-flex align-items-center position-absolute bottom-0 mb-4 pb-xl-2"></div>

          </div>
        </div>

        <div class="mb-3 pb-2 pb-xl-3"></div>

        <div class="d-flex justify-content-between mb-4 pb-md-2">
          <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
            <a href="{{route('home.index')}}" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
            <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
            <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
          </div>

          <div class="shop-acs d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1" >
            <select class="shop-acs__select form-select w-auto border-0 py-0 order-1 order-md-0 bg-transparent" aria-label="Sort Items"
              name="orderby" id="orderby">
              <option value="-1" {{$order == -1 ? 'selected':''}}>Default</option>
              <option value="1" {{$order == 1 ? 'selected':''}}>Date, New to Old</option>
              <option value="2" {{$order == 2 ? 'selected':''}}>Date, Old to New</option>
              <option value="3" {{$order == 3 ? 'selected':''}}>Price, Low to High</option>
              <option value="4" {{$order == 4 ? 'selected':''}}>Price, High to Low</option>
              
            </select>

            <div class="shop-asc__seprator mx-3 d-none d-md-block order-md-0"></div>

            <div class="col-size align-items-center order-1 d-none d-lg-flex">
              <span class="text-uppercase fw-medium me-2">View</span>
              <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid" data-cols="2">2</button>
              <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid" data-cols="3">3</button>
              <button class="btn-link fw-medium js-cols-size" data-target="products-grid" data-cols="4">4</button>
            </div>

            <div class="shop-filter d-flex align-items-center order-0 order-md-3 d-lg-none">
              <button class="btn-link btn-link_f d-flex align-items-center ps-0 js-open-aside" data-aside="shopFilter">
                <svg class="d-inline-block align-middle me-2" width="14" height="10" viewBox="0 0 14 10" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_filter" />
                </svg>
                <span class="text-uppercase fw-medium d-inline-block align-middle">Filter</span>
              </button>
            </div>
          </div>
        </div>

        <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">
        @foreach ($products as $product)            
          <div class="product-card-wrapper">
            <div class="product-card mb-3 mb-md-4 mb-xxl-5">
              <div class="pc__img-wrapper">
                <div class="swiper-container background-img js-swiper-slider" data-settings='{"resizeObserver": true}'>
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <a href="{{route('shop.product.details',['product_slug'=>$product->slug])}}"><img loading="lazy" src="{{asset('uploads/products')}}/{{$product->image}}" width="330"
                          height="400" alt="{{$product->name}}" class="pc__img"></a>
                    </div>
                    <div class="swiper-slide">
                        @foreach (explode(",",$product->images) as $gimg)
                      <a href="{{route('shop.product.details',['product_slug'=>$product->slug])}}"><img loading="lazy" src="{{asset('uploads/products')}}/{{$gimg}}"
                          width="330" height="400" alt="{{$product->name}}" class="pc__img"></a>
                        @endforeach
                    </div>
                  </div>
                  <span class="pc__img-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                      xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_prev_sm" />
                    </svg></span>
                  <span class="pc__img-next"><svg width="7" height="11" viewBox="0 0 7 11"
                      xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_next_sm" />
                    </svg></span>
                </div>
                @if(Cart::instance('cart')->content()->where('id',$product->id)->count()>0)
                  <a href="{{route('cart.index')}}" class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium btn-warning mb-3">Go to Cart</a>
                @else
                <form name="addtocart-form" method="post" action="{{route('cart.add')}}">
                  @csrf
                  <input type="hidden" name="id" value="{{$product->id}}"/>
                  <input type="hidden" name="quantity" value="1"/>
                  <input type="hidden" name="name" value="{{$product->name}}"/>
                  <input type="hidden" name="price" value="{{$product->sale_price == '' ? $product->regular_price : $product->sale_price}}"/>
                <button type="submit"
                  class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium"
                  data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                </form>
                @endif
              </div>

              <div class="pc__info position-relative bg-transparent">
                <p class="pc__category">{{$product->subcategory->name}}</p>
                <h6 class="pc__title"><a href="{{route('shop.product.details',['product_slug'=>$product->slug])}}">{{$product->name}}</a></h6>
                <div class="product-card__price d-flex">
                  <span class="money price">
                    @if($product->sale_price)
                    <s>Rp {{ number_format($product->regular_price, 0, ',', '.') }}</s>
                      Rp {{ number_format($product->sale_price, 0, ',', '.') }}
                    @else
                    Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                    @endif
                  </span>
                </div>
                <div class="product-card__review d-flex align-items-center">
                  <div class="reviews-group d-flex">
                    <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_star" />
                    </svg>
                    <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_star" />
                    </svg>
                    <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_star" />
                    </svg>
                    <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_star" />
                    </svg>
                    <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_star" />
                    </svg>
                  </div>
                  <span class="reviews-note text-lowercase text-secondary ms-1">8k+ reviews</span>
                </div>

            @if(Cart::instance('wishlist')->content()->where('id',$product->id)->count() > 0)
            <form method="POST" action="{{route('wishlist.item.remove',['rowId'=>Cart::instance('wishlist')->content()->where('id',$product->id)->first()->rowId])}}">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="pc__btn-wl position-absolute top-0 end-0 border-0 bg-transparent heart-filled"
                title="Remove from Wishlist">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="pink" xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_heart" />
                </svg>
              </button>
            </form>
            @else
            <form method="POST" action="{{route('wishlist.add')}}">
              @csrf
              <input type="hidden" name="id" value="{{$product->id}}"/>
              <input type="hidden" name="name" value="{{$product->name}}"/>
              <input type="hidden" name="price" value="{{$product->sale_price == '' ? $product->regular_price : $product->sale_price}}"/>
              <input type="hidden" name="quantity" value="1"/>
              <button type="submit"
                class="pc__btn-wl position-absolute top-0 end-0 border-0 bg-transparent heart-outline"
                title="Add To Wishlist">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="pink" xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_heart" />
                </svg>
              </button>
            </form>
            @endif


              </div>
            </div>
          </div>
          @endforeach

    
        </div>

        <div class="divider"></div>
      <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
            {{$products->withQueryString()->links('pagination::bootstrap-5')}}
      </div>
      
      </div>
    </section>
  </main>

  <form id="frmfilter" method="GET" action="{{route('shop.index')}}">
    <input type="hidden" name="page" value="{{$products->currentPage()}}">
    <input type="hidden" name="order" id="order" value="{{$order}}"/>
    <input type="hidden" name="subcategories" id="hdnsubCategories"/>
    <input type="hidden" name="min" id="hdnMinPrice" value="{{$min_price}}"/>
    <input type="hidden" name="max" id="hdnMaxPrice" value="{{$max_price}}"/>
  </form>
@endsection

@push('scripts')
<script>
    $(function(){

      $("#orderby").on("change",function(){
        $("#order").val($("#orderby option:selected").val());
        $("#frmfilter").submit();
      });

      $("input[name='subcategories']").on("change",function(){
        var subcategories = "";
        $("input[name='subcategories']:checked").each(function(){
          if(subcategories == "")
            {
              subcategories += $(this).val();
            }
            else{
              subcategories += "," + $(this).val();
            }
        });
        $("#hdnsubCategories").val(subcategories);
        $("#frmfilter").submit();
      });

      $("[name='price_range']").on("change",function(){
        var min = $(this).val().split(',')[0];
        var max = $(this).val().split(',')[1];
        $("#hdnMinPrice").val(min);
        $("#hdnMaxPrice").val(max);
        setTimeout(() => {
          $("#frmfilter").submit();
        }, 2000);
      });
    });
  </script>
@endpush    