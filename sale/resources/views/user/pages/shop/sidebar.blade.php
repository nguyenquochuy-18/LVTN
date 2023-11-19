<div class="shop__sidebar">
    <div class="shop__sidebar__search">
        <form action="" method="GET">
            <input type="text" placeholder="Tìm kiếm..." name="name" value="{{ old('name', request()->name) }}">
            <button type="submit"><span class="icon_search"></span></button>
        </form>
    </div>
    <div class="shop__sidebar__accordion">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-heading">
                    <a data-toggle="collapse" data-target="#collapseOne">Danh mục</a>
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="shop__sidebar__categories">
                            <ul class="nice-scroll">
                                @foreach($categoriesSidebar as $category)
                                    <li>
                                        <a href="{{ route('shop.category', $category->slug) }}"
                                            @if(isset($slug) && $slug === $category->slug)
                                                class="active"
                                            @endif    
                                        >
                                            {{ $category->name }} ({{ count($category->products) }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-heading">
                    <a data-toggle="collapse" data-target="#collapseTwo">Thương hiệu</a>
                </div>
                <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="shop__sidebar__brand">
                            <ul>
                                <form action="" method="GET" id="form-brand">
                                    <input type="hidden" name="brand">
                                </form>
                                @foreach ($brands as $brand)
                                <li>
                                    <a href="javascript:;" data-brand="{{ $brand }}"
                                       @if (request()->has('brand') && request()->brand === $brand)
                                            class="active"
                                       @endif
                                    >
                                        {{ $brand }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
