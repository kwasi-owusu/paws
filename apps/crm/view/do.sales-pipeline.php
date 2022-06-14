<?php
require_once '../../template/index.php';

require_once 'DoCustomerCors.php';
$page_name         = "sales_pipeline";
$getToken          = DoCustomerCors::salesPipeline($page_name);

$_SESSION['pipeline']  = $getToken;


require_once('../controller/GetAllSalesLead.php');
?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="compose-box">
                            <div class="compose-content" id="addTaskModalTitle">
                                <h5 class="add-task-title">Add Task</h5>
                                <h5 class="edit-task-title">Edit Task</h5>

                                <div class="addTaskAccordion" id="add_task_accordion">
                                    <div class="card task-text-progress">
                                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#add_task_accordion">
                                            <div class="card-body">
                                                <form action="javascript:void(0);">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="task-title mb-4">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">
                                                                    <path d="M12 20h9"></path>
                                                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                                                </svg>
                                                                <input id="s-task" type="text" placeholder="Task" class="form-control" name="task">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="task-badge">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">
                                                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                                </svg>
                                                                <textarea id="s-text" placeholder="Task Text" class="form-control" name="taskText"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg> Discard</button>
                        <button data-btnfn="addTask" class="btn add-tsk">Add Task</button>
                        <button data-btnfn="editTask" class="btn edit-tsk" style="display: none;">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addListModal" tabindex="-1" role="dialog" aria-labelledby="addListModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="compose-box">
                            <div class="compose-content" id="addListModalTitle">
                                <h5 class="add-list-title">Add List</h5>
                                <h5 class="edit-list-title">Edit List</h5>
                                <form action="javascript:void(0);">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="list-title">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list">
                                                    <line x1="8" y1="6" x2="21" y2="6"></line>
                                                    <line x1="8" y1="12" x2="21" y2="12"></line>
                                                    <line x1="8" y1="18" x2="21" y2="18"></line>
                                                    <line x1="3" y1="6" x2="3" y2="6"></line>
                                                    <line x1="3" y1="12" x2="3" y2="12"></line>
                                                    <line x1="3" y1="18" x2="3" y2="18"></line>
                                                </svg>
                                                <input id="s-list-name" type="text" placeholder="List Name" class="form-control" name="task">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg> Discard</button>
                        <button class="btn add-list">Add List</button>
                        <button class="btn edit-list" style="display: none;">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteConformation" tabindex="-1" role="dialog" aria-labelledby="deleteConformationLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" id="deleteConformationLabel">
                    <div class="modal-header">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                        </div>
                        <h5 class="modal-title" id="exampleModalLabel">Delete the task?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="">If you delete the task it will be gone forever. Are you sure you want to proceed?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" data-remove="task">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row scrumboard" id="cancel-row" style="overflow-y: scroll; height: 600px;">
            <div class="col-lg-12 layout-spacing">

                <div class="task-list-section">

                    <div data-section="s-new" class="task-list-container" data-connect="sorting">

                        <div class="connect-sorting">
                            <div class="task-container-header">
                                <h6 class="s-heading" data-listTitle="Prospecting">Prospecting</h6>
                            </div>

                            <div class="connect-sorting-content" data-sortable="true" id="Prospecting">

                                <?php

                                $callProspecting = GetAllSalesLead::getAllProspectingPipeline();

                                foreach ($callProspecting as $cps) {

                                ?>

                                    <div data-draggable="true" class="card img-task" style="" id="<?php echo $cps['pipeline_ID']; ?>">
                                        <div class="card-body">
                                            <div class="task-header">
                                                <div class="">
                                                    <h4 class="" data-taskTitle="<?php echo $cps['lead_name']; ?>"><?php echo $cps['lead_name']; ?></h4>
                                                </div>
                                            </div>

                                            <div class="task-body">

                                                <div class="task-bottom">
                                                    <div class="tb-section-1">
                                                        <span data-taskDate="08 Aug 2020"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                                            </svg> <?php
                                                                    //$lead_date = strtotime($cps['system_date']);
                                                                    echo Date('Y-M-d', strtotime($cps['system_date'])); ?>

                                                        </span>
                                                    </div>
                                                    <div class="tb-section-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 s-task-edit">
                                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 s-task-delete">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        </svg>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>

                        </div>
                    </div>


                    <div data-section="s-in-progress" class="task-list-container" data-connect="sorting">
                        <div class="connect-sorting">
                            <div class="task-container-header">
                                <h6 class="s-heading" data-listTitle="Qualifying">Qualifying</h6>
                            </div>

                            <div class="connect-sorting-content" data-sortable="true" id="Qualifying">

                                <?php

                                $callQualifying = GetAllSalesLead::getAllQualifyingPipeline();

                                foreach ($callQualifying as $qlf) {

                                ?>
                                    <div data-draggable="true" class="card img-task" style="" id="<?php echo $qlf['pipeline_ID']; ?>">
                                        <div class="card-body">
                                            <div class="task-header">
                                                <div class="">
                                                    <h4 class="" data-taskTitle="<?php echo $qlf['lead_name']; ?>"><?php echo $qlf['lead_name']; ?></h4>
                                                </div>
                                            </div>

                                            <div class="task-body">

                                                <div class="task-bottom">
                                                    <div class="tb-section-1">
                                                        <span data-taskDate="08 Aug 2020"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                                            </svg> <?php
                                                                    //$lead_date = strtotime($cps['system_date']);
                                                                    echo Date('Y-M-d', strtotime($qlf['system_date'])); ?>

                                                        </span>
                                                    </div>
                                                    <div class="tb-section-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 s-task-edit">
                                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 s-task-delete">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        </svg>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>

                        </div>
                    </div>

                    <div data-section="s-in-progress" class="task-list-container" data-connect="sorting">
                        <div class="connect-sorting">
                            <div class="task-container-header">
                                <h6 class="s-heading" data-listTitle="Contacting">Contacting</h6>
                            </div>

                            <div class="connect-sorting-content" data-sortable="true" id="Contacting">

                                <?php

                                $callContacting = GetAllSalesLead::getAllContactingPipeline();

                                foreach ($callContacting as $ctg) {

                                ?>
                                    <div data-draggable="true" class="card img-task" style="" id="<?php echo $ctg['pipeline_ID']; ?>">
                                        <div class="card-body">
                                            <div class="task-header">
                                                <div class="">
                                                    <h4 class="" data-taskTitle="<?php echo $ctg['lead_name']; ?>"><?php echo $ctg['lead_name']; ?></h4>
                                                </div>
                                            </div>

                                            <div class="task-body">

                                                <div class="task-bottom">
                                                    <div class="tb-section-1">
                                                        <span data-taskDate="08 Aug 2020"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                                            </svg>
                                                            <?php
                                                            echo Date('Y-M-d', strtotime($ctg['system_date']));
                                                            ?>

                                                        </span>
                                                    </div>
                                                    <div class="tb-section-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 s-task-edit">
                                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 s-task-delete">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        </svg>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>

                        </div>
                    </div>

                    <div data-section="s-in-progress" class="task-list-container" data-connect="sorting">
                        <div class="connect-sorting">
                            <div class="task-container-header">
                                <h6 class="s-heading" data-listTitle="Negotiation">Negotiation</h6>
                            </div>

                            <div class="connect-sorting-content" data-sortable="true" id="Negotiation">

                                <?php

                                $callNegotiating = GetAllSalesLead::getAlNegotiationPipeline();

                                foreach ($callNegotiating as $ngt) {

                                ?>
                                    <div data-draggable="true" class="card img-task" style="" id="<?php echo $ngt['pipeline_ID']; ?>">
                                        <div class="card-body">
                                            <div class="task-header">
                                                <div class="">
                                                    <h4 class="" data-taskTitle="<?php echo $ngt['lead_name']; ?>"><?php echo $ngt['lead_name']; ?></h4>
                                                </div>
                                            </div>

                                            <div class="task-body">

                                                <div class="task-bottom">
                                                    <div class="tb-section-1">
                                                        <span data-taskDate="08 Aug 2020"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                                            </svg>
                                                            <?php
                                                            echo Date('Y-M-d', strtotime($ngt['system_date']));
                                                            ?>

                                                        </span>
                                                    </div>
                                                    <div class="tb-section-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 s-task-edit">
                                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 s-task-delete">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        </svg>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>

                        </div>
                    </div>

                    <div data-section="s-in-progress" class="task-list-container" data-connect="sorting">
                        <div class="connect-sorting">
                            <div class="task-container-header">
                                <h6 class="s-heading" data-listTitle="Closed Won">Closed Won</h6>
                            </div>

                            <div class="connect-sorting-content" data-sortable="true" id="Closed Won">

                                <?php

                                $callWon = GetAllSalesLead::getWonPipeline();

                                foreach ($callWon as $won) {

                                ?>
                                    <div data-draggable="true" class="card img-task" style="" id="<?php echo $won['pipeline_ID']; ?>">
                                        <div class="card-body">
                                            <div class="task-header">
                                                <div class="">
                                                    <h4 class="" data-taskTitle="<?php echo $won['lead_name']; ?>"><?php echo $won['lead_name']; ?></h4>
                                                </div>
                                            </div>

                                            <div class="task-body">

                                                <div class="task-bottom">
                                                    <div class="tb-section-1">
                                                        <span data-taskDate="08 Aug 2020"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                                            </svg>
                                                            <?php
                                                            echo Date('Y-M-d', strtotime($won['system_date']));
                                                            ?>

                                                        </span>
                                                    </div>
                                                    <div class="tb-section-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 s-task-edit">
                                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 s-task-delete">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        </svg>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>

                        </div>
                    </div>

                    <div data-section="s-in-progress" class="task-list-container" data-connect="sorting">
                        <div class="connect-sorting">
                            <div class="task-container-header">
                                <h6 class="s-heading" data-listTitle="Closed Won">Closed Won</h6>
                            </div>

                            <div class="connect-sorting-content" data-sortable="true" id="Closed Won">

                                <?php

                                $callLost = GetAllSalesLead::getLostPipeline();

                                foreach ($callLost as $lost) {

                                ?>
                                    <div data-draggable="true" class="card img-task" style="" id="<?php echo $ngt['pipeline_ID']; ?>">
                                        <div class="card-body">
                                            <div class="task-header">
                                                <div class="">
                                                    <h4 class="" data-taskTitle="<?php echo $lost['lead_name']; ?>"><?php echo $lost['lead_name']; ?></h4>
                                                </div>
                                            </div>

                                            <div class="task-body">

                                                <div class="task-bottom">
                                                    <div class="tb-section-1">
                                                        <span data-taskDate="08 Aug 2020"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                                            </svg>
                                                            <?php
                                                            echo Date('Y-M-d', strtotime($lost['system_date']));
                                                            ?>

                                                        </span>
                                                    </div>
                                                    <div class="tb-section-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 s-task-edit">
                                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 s-task-delete">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        </svg>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="loader multi-loader mx-auto" style="display: none;" id="loader"></div>
            <p style="display: none" id="pipeCors"><?php echo $getToken; ?></p>

            <span id="response"></span>
            

        </div>

    </div>
</div>
</div>

<?php
require_once '../../template/footer.php';
?>

<script src="template/statics/assets/plugins/notification/snackbar/snackbar.min.js"></script>
<script src="template/statics/assets/js/components/notification/custom-snackbar.js"></script>

<!-- <script src="template/statics/assets/js/ie11fix/fn.fix-padStart.js"></script> -->
<script src="template/statics/assets/js/apps/scrumboard.js"></script>
<script src="crm/js/extra.js"></script>

</body>

</html>