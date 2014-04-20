<div class="modal fade" id="search-record" tabindex="-1" role="dialog" aria-labelledby="search-record-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="search-chain-label">搜索放映</h4>
            </div>
            <div class="modal-body">
                <div id="alert"></div>
                <form role="form">
                    <div class="form-group">
                        <label for="chain-name">院线</label>
                        <input type="text" class="form-control" id="chain-name">    
                    </div>
                    <div class="form-group">
                        <label for="film-name">电影</label>
                        <input class="form-control" id="film-name" type="text">
                    </div>
                    <div class="form-group">
                        <label for="user-name">放影员</label>
                        <input type="text" class="form-control" id="user-name"> 
                    </div>
                    <div class="form-group">
                        <label for="date-time-begin">开始时间</label>
                        <div class="input-append date form_datetime">
                            <input class="form-control" id="date-time-begin" type="text" value="" readonly>
                            <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date-time-end">结束时间</label>
                        <div class="input-append date form_datetime">
                            <input class="form-control" id="date-time-end" type="text" value="" readonly>
                            <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="location">地点</label>
                        <input type="text" class="form-control" id="location">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="search-record-cancel" type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button id="search-record-submit" type="button" class="btn
                    btn-primary">搜索</button>
            </div>
        </div>
    </div>
</div>
