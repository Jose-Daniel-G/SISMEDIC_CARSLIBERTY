<div class="modal fade" id="claseModal" tabindex="-1" aria-labelledby="claseModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="claseModal">Agenda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.events.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        @can('admin.listUsers')
                            <div class="col-md-12">
                                <div class="form-group"><label for="cliente_id">Estudiante</label>
                                    <select name="cliente_id" id="cliente_id" class="form-control">
                                        <option value="" selected disabled>Seleccione un Estudiante
                                        </option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">
                                                {{ $cliente->nombres . ' ' . $cliente->apellidos }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('cliente_id')
                                        <small class="bg-danger text-white p-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        @endcan

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="cliente_id">Curso</label>
                                <select name="cursoid" class="form-control" id="cursoid">
                                    <option value="" selected disabled>Seleccione un Curso</option>
                                    @foreach ($cursos as $curso)
                                        <option value="{{ $curso->id }}">
                                            {{ $curso->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cursoid')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="profesorid">Profesor</label>
                                <select name="profesorid" class="form-control" id="profesorid">
                                    <option value="" selected disabled>Seleccione un Profesor</option>
                                </select>
                                @error('profesorid')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="profesor">Fecha de reserva</label>
                                <input type="date" class="form-control" name="fecha_reserva" id="fecha_reserva"
                                    value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group"><label for="hora_inicio">Hora inicio</label>
                                <input type="time" class="form-control" name="hora_inicio" id="hora_inicio">
                                @error('hora_inicio')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"><label for="hora_fin">Horas</label>
                                <input type="number" class="form-control" name="hora_fin" id="hora_fin">
                                @error('hora_fin')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
