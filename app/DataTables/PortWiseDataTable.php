<?php

namespace App\DataTables;

use App\Models\PortWise;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PortWiseDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" class="select-checkbox" value="' . $row->id . '">';
            })
            ->addColumn('action', function ($row) {
                $tableName = (new PortWise())->getTable();
                $encryptedId = encrypt($row->id);
                $actionBtn = '';
                if (Auth::user()->can('portwise-delete')) {
                    $actionBtn .= ' <a href="javascript:void(0)" onclick="deleteData(\'id\', ' . $row->id . ', \'' . $tableName . '\')" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash-o"></i></a>';
                }
                return $actionBtn;
            })
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('d-m-Y H:i');
            })
            ->editColumn('updated_at', function ($row) {
                return Carbon::parse($row->updated_at)->format('d-m-Y H:i');
            })
            ->filter(function ($query) {
                $columns = Schema::getColumnListing('port_wises');
                $filterableColumns = array_filter($columns, function ($column) {
                    return !in_array($column, ['id', 'created_at', 'updated_at']);
                });
                foreach ($filterableColumns as $column) {
                    $value = strtolower(str_replace('_', '', $column));
                    if (request()->has($value) && !empty(request($value))) {
                        if ($column == 'created_at' || $column == 'updated_at') {
                            $query->whereDate($column, request($value));
                        } else {
                            $query->where($column, 'like', '%' . request($value) . '%');
                        }
                    }
                }
            })
            ->setRowId('id')
            ->rawColumns(['checkbox', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PortWise $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('portwise-table')
            ->addTableClass('global-datatable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->searching(false)
            ->serverSide(true)
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->initComplete('function () {
                var api = this.api();

                    $(\'#portwise-table thead\').prepend(\'<tr class="filter-row"></tr>\');
                    $(\'#portwise-table thead th\').each(function (i) {
                        var title = $(this).text();
                        var className = $(this).text().trim().replace(/\s+/g, "").toLowerCase();
                        var columnWidth = $(this).width();
                        if (i === 0 || i === 1) {
                            $(\'#portwise-table thead .filter-row\').append(\'<th></th>\');
                        } else {
                            // For other columns, add an input box in the new filter row
                            $(\'#portwise-table thead .filter-row\').append(\'<th><input type="text" placeholder="Search \' + title + \'" class="\' + className + \'" style="width: 100%;height:30px;" /></th>\');
                        }
                    });

            }')
            ->buttons([
                Button::make('export')->action("function () {
                   var checkedRows = window.LaravelDataTables['portwise-table'].$('.select-checkbox:checked').map(function() {
                        return $(this).val();
                    }).get();


                    if (checkedRows.length > 0) {
                        $.ajax({
                            url: '" . route('admin.portwise.export') . "',
                            method: 'GET',
                            data: { ids: checkedRows },
                            success: function(response) {
                                if (response.status === 1) {
                                    var link = document.createElement('a');
                                    link.href = response.url;
                                    link.download = 'portwise.xlsx';
                                    document.body.appendChild(link);
                                    link.click();
                                    document.body.removeChild(link);
                                    toastr.success('Data export successfully.');
                                } else {
                                    toastr.error(response.message);
                                }
                            },
                            error: function(xhr) {
                                try {
                                    var response = JSON.parse(xhr.responseText);
                                    if (response && response.message) {
                                        toastr.error(response.message);
                                    } else {
                                        toastr.error('An unexpected error occurred. Please try again.');
                                    }
                                } catch (e) {
                                    toastr.error('Error parsing error response.');
                                }
                            }
                        });
                    } else {
                        toastr.error('No rows selected');
                    }
                }")->addClass('btn btn-secondary text-light')
            ]);
    }



    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('SN')->searchable(false),
            Column::make('checkbox')
                ->title('<input type="checkbox" id="master" />')
                ->searchable(false)
                ->orderable(false)
                ->exportable(false)
                ->addClass('text-nowrap'),
            Column::make('CUSH')->addClass('text-nowrap'),
            Column::make('INDIAN_PORT')->addClass('text-nowrap'),
            Column::make('BE_NO')->addClass('text-nowrap'),
            Column::make('BE_DATE')->addClass('text-nowrap')->addClass('text-nowrap'),
            Column::make('IEC')->addClass('text-nowrap')->addClass('text-nowrap'),
            Column::make('IMPORTER')->addClass('text-nowrap')->addClass('text-nowrap'),
            Column::make('ADDRESS')->addClass('text-nowrap')->addClass('text-nowrap'),
            Column::make('CITY')->addClass('text-nowrap')->addClass('text-nowrap'),
            Column::make('CHA_NO')->addClass('text-nowrap')->addClass('text-nowrap'),
            Column::make('COUNTRY')->addClass('text-nowrap')->addClass('text-nowrap'),
            Column::make('CTH')->addClass('text-nowrap')->addClass('text-nowrap'),
            Column::make('ITEM')->addClass('text-nowrap')->addClass('text-nowrap'),
            Column::make('QTY')->addClass('text-nowrap')->addClass('text-nowrap'),
            Column::make('UQC')->addClass('text-nowrap')->addClass('text-nowrap'),
            Column::make('UNIT_VALUE')->addClass('text-nowrap'),
            Column::make('TOTAL_VALUE')->addClass('text-nowrap'),
            Column::make('UPI')->addClass('text-nowrap'),
            Column::make('ASSESS_USD')->addClass('text-nowrap'),
            Column::make('Total_Duty_Paid')->addClass('text-nowrap'),
            Column::make('AG')->addClass('text-nowrap'),
            Column::make('Port_Of_Shipment')->addClass('text-nowrap'),
            Column::make('Invoice_Currency')->addClass('text-nowrap'),
            Column::make('Supp_Name')->addClass('text-nowrap'),
            Column::make('Supp_Address')->addClass('text-nowrap'),
            Column::make('InvoiceUnitPriceFC')->addClass('text-nowrap'),
            Column::make('TYPE')->addClass('text-nowrap'),
            Column::make('created_at')->addClass('text-nowrap'),
            Column::make('updated_at')->addClass('text-nowrap'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->visible(auth()->user()->can('portwise-delete')),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PortWise_' . date('YmdHis');
    }

    public function export()
    {
        return '<a href="' . route('portWise.export') . '?extension=csv" class="btn btn-sm btn-primary">Export CSV</a>
                <a href="' . route('portWise.export') . '?extension=excel" class="btn btn-sm btn-primary">Export Excel</a>';
    }
}
