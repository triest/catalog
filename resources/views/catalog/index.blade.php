@extends('layouts.app')

@section('content')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="table-responsive px-3">
                                            <table class="table table-striped align-middle table-nowrap">
                                                <tbody>
                                                @foreach($goods as $good)
                                                <tr>
                                                    <td>
                                                        <div class="avatar-lg me-4">
                                                            <img src="https://www.bootdey.com/image/380x380/00FFFF/000000" class="img-fluid rounded" alt="">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div>
                                                            <h5 class="font-size-18"><a href="ecommerce-product-detail.html" class="text-dark">{{$good->name}}</a></h5>
                                                        </div>
                                                    </td>


                                                    <td style="width: 220px;">
                                                        <h3 class="mb-0 font-size-20"><span class="text-muted me-2"></span><b>{{$good->price}}$</b></h3>
                                                    </td>


                                                    <td>
                                                        <form method="post" action="{{route('shopping-cart.store')}}">
                                                            @method('POST')
                                                            @csrf
                                                           <input type="number" name="quantity">
                                                            <input type="hidden" name="good_id" value="{{$good->id}}">
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="bx bx-cart me-2 font-size-15 align-middle"></i> Add</button>
                                                        </form>
                                                    </td>
                                                </tr>


                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                {{ $goods->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
