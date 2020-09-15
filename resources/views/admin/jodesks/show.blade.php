@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.jodesk.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.jodesks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.jodesk.fields.id') }}
                        </th>
                        <td>
                            {{ $jodesk->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jodesk.fields.nama_jodesk') }}
                        </th>
                        <td>
                            {{ $jodesk->nama_jodesk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jodesk.fields.deskripsi') }}
                        </th>
                        <td>
                            {{ $jodesk->deskripsi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jodesk.fields.status') }}
                        </th>
                        <td>
                            {{ App\Jodesk::STATUS_SELECT[$jodesk->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jodesk.fields.petugas') }}
                        </th>
                        <td>
                            @foreach($jodesk->petugas as $key => $petugas)
                                <span class="label label-info">{{ $petugas->nama }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.jodesks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
