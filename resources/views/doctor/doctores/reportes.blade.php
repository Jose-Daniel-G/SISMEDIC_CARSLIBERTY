@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="row" style="margin-left:40px">
        <h1>Reportes de doctores</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Generar reporte</h3>
                </div>

                    <div class="card-body">

                        <a href="{{ url('/admin/doctores/pdf') }}" class="btn btn-success"><i class="bi bi-printer"></i>Listado del personal médico</a>

                    </div>

            </div>

        </div>
    </div>
@stop