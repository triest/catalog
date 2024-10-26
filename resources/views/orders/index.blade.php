@extends('layouts.app')

@section('content')
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
                                            <thead>
                                            <tr>
                                                <td>N</td>
                                                <td>Дата создания</td>
                                                <td>Состав заказа</td>
                                                <td>Стоимость заказа</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orders as $order)
                                                <tr>
                                                    <td>
                                                        <div class="avatar-lg me-4">
                                                            {{$order->id}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="avatar-lg me-4">
                                                            {{$order->created_at}}
                                                        </div>
                                                    </td>
                                                    <td style="width: 220px;">
                                                        {{$order->getItemsString()}}
                                                    </td>
                                                    <td>
                                                        {{$order->calculatedPrice()}}
                                                    </td>

                                                    <td>
                                                        <form method="post"
                                                              action="{{route('order.destroy',['order'=>$order])}}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit"
                                                                    class="btn btn-danger waves-effect waves-light"><i
                                                                    class="bx bx-cart me-2 font-size-15 align-middle"></i>
                                                                Удалить
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                        Стоимость всех заказов: {{$cost}}
                                    </div>
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
