<?php

namespace App\DataTables;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LeadsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('checkbox', function($lead) {
                return '<input type="checkbox" name="leads[]" value="' . $lead->id . '" class="lead-checkbox">';
            })
            ->addColumn('lead_info', function($lead) {
                $html = '<div><strong>' . $lead->title . '</strong>';
                if ($lead->company) {
                    $html .= '<br><small class="text-muted">' . $lead->company . '</small>';
                }
                $html .= '</div>';
                return $html;
            })
            ->addColumn('contact_info', function($lead) {
                $html = '<div><strong>' . $lead->contact_name . '</strong>';
                $html .= '<br><small class="text-muted">' . $lead->contact_email . '</small>';
                if ($lead->contact_phone) {
                    $html .= '<br><small class="text-muted">' . $lead->contact_phone . '</small>';
                }
                $html .= '</div>';
                return $html;
            })
            ->addColumn('source_badge', function($lead) {
                return $lead->source_badge;
            })
            ->addColumn('status_badge', function($lead) {
                return $lead->status_badge;
            })
            ->addColumn('priority_badge', function($lead) {
                return $lead->priority_badge;
            })
            ->addColumn('value', function($lead) {
                if ($lead->value) {
                    return '<span class="text-success font-weight-bold">' . $lead->formatted_value . '</span>';
                }
                return '<span class="text-muted">N/A</span>';
            })
            ->addColumn('assigned_to', function($lead) {
                if ($lead->assignedUser) {
                    return '<div class="d-flex align-items-center">
                                <img alt="image" src="' . url('assets-admin/img/avatar/avatar-1.png') . '" class="rounded-circle mr-2" width="35">
                                <div>' . $lead->assignedUser->name . '</div>
                            </div>';
                }
                return '<span class="badge badge-secondary">Unassigned</span>';
            })
            ->addColumn('created_at', function($lead) {
                return '<div>
                            <small>' . $lead->created_at->format('M d, Y') . '</small>
                            <br><small class="text-muted">' . $lead->created_at->diffForHumans() . '</small>
                        </div>';
            })
            ->addColumn('actions', function($lead) {
                return '<div class="btn-group" role="group">
                            <a href="' . route('admin.leads.show', $lead->id) . '" class="btn btn-sm btn-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="' . route('admin.leads.edit', $lead->id) . '" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" title="Delete" onclick="deleteLead(' . $lead->id . ')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
            })
            ->rawColumns(['checkbox', 'lead_info', 'contact_info', 'source_badge', 'status_badge', 'priority_badge', 'value', 'assigned_to', 'created_at', 'actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Lead $model): QueryBuilder
    {
        $query = $model->with(['assignedUser', 'createdByUser']);

        // Apply filters
        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }

        if (request()->filled('priority')) {
            $query->where('priority', request('priority'));
        }

        if (request()->filled('source')) {
            $query->where('source', request('source'));
        }

        if (request()->filled('assigned_to')) {
            $query->where('assigned_to', request('assigned_to'));
        }

        if (request()->filled('date_from')) {
            $query->whereDate('created_at', '>=', request('date_from'));
        }

        if (request()->filled('date_to')) {
            $query->whereDate('created_at', '<=', request('date_to'));
        }

        if (request()->filled('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('contact_name', 'like', "%{$search}%")
                  ->orWhere('contact_email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('leadsTable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(8, 'desc') // Order by created_at column
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ])
                    ->parameters([
                        'scrollX' => true,
                        'responsive' => true,
                        'autoWidth' => false,
                        'pageLength' => 25,
                        'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                        'initComplete' => "function() {
                            this.api().columns().every(function() {
                                var column = this;
                                var title = column.header().textContent;
                                
                                // Skip checkbox and actions columns
                                if (title === 'Checkbox' || title === 'Actions') {
                                    return;
                                }
                                
                                var input = document.createElement('input');
                                input.placeholder = 'Filter ' + title;
                                input.className = 'form-control form-control-sm';
                                
                                $(input).appendTo($(column.header()))
                                .on('change clear', function() {
                                    if (column.search() !== this.value) {
                                        column.search(this.value).draw();
                                    }
                                });
                            });
                        }"
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('checkbox')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->title('Checkbox'),
            Column::computed('lead_info')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->title('Lead'),
            Column::computed('contact_info')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->title('Contact'),
            Column::computed('source_badge')
                  ->exportable(false)
                  ->printable(false)
                  ->width(120)
                  ->title('Source'),
            Column::computed('status_badge')
                  ->exportable(false)
                  ->printable(false)
                  ->width(120)
                  ->title('Status'),
            Column::computed('priority_badge')
                  ->exportable(false)
                  ->printable(false)
                  ->width(120)
                  ->title('Priority'),
            Column::computed('value')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
                  ->title('Value'),
            Column::computed('assigned_to')
                  ->exportable(false)
                  ->printable(false)
                  ->width(150)
                  ->title('Assigned To'),
            Column::computed('created_at')
                  ->exportable(false)
                  ->printable(false)
                  ->width(120)
                  ->title('Created'),
            Column::computed('actions')
                  ->exportable(false)
                  ->printable(false)
                  ->width(120)
                  ->addClass('text-center')
                  ->title('Actions'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Leads_' . date('YmdHis');
    }
}
