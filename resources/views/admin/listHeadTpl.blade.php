@if (array_get ($data, 'status.templet') === '#statusText')
    <script type="text/html" id="statusText">
        <%# if(d.status === 1) { %>
        <span class="layui-badge layui-bg-green">启用</span>
        <%# } else { %>
        <span class="layui-badge layui-bg-red">禁用</span>
        <%# } %>
    </script>
@endif
@if (array_get ($data, 'status.templet') === '#statusSwitch')
    <script type="text/html" id="statusSwitch">
        <input type="checkbox" name="status" lay-skin="switch" lay-text="启用|禁用"
        <%# if (d.status == 1) { %>
        checked
        <%# } %>
        >
    </script>
@endif
@if (array_get ($data, 'enable.templet') === '#enableText')
    <script type="text/html" id="enableText">
        <%# if(d.enable === 1) { %>
        <span class="layui-badge layui-bg-green">启用</span>
        <%# } else { %>
        <span class="layui-badge layui-bg-red">禁用</span>
        <%# } %>
    </script>
@endif
@if (array_get ($data, 'attachment.templet') === '#attachmentText')
    <script type="text/html" id="attachmentText">
        <%# if(d.attachment) { %>
        <a class="layui-table-link" href="<% d.attachment.path %>"><% d.attachment.name %></a>
        <%# } else { %>

        <%# } %>
    </script>
@endif
@if (array_get ($data, 'pid.templet') === '#pidText')
    <script type="text/html" id="pidText">
        <%# if(d.parent) { %>
        <% d.parent.name %>
        <%# } else { %>
        --
        <%# } %>
    </script>
@endif
@if (array_get ($data, 'department.templet') === '#departmentText')
    <script type="text/html" id="departmentText">
        <%# if(d.department) { %>
        <% d.department.name %>
        <%# } else { %>
        --
        <%# } %>
    </script>
@endif
@if (array_get ($data, 'adapter.templet') === '#adapterText')
    <script type="text/html" id="adapterText">
        <%# if(d.adapter) { %>
        <% d.adapter.name %>
        <%# } else { %>
        --
        <%# } %>
    </script>
@endif
@if (array_get ($data, 'category.templet') === '#categoryText')
    <script type="text/html" id="categoryText">
        <%# if(d.category) { %>
        <% d.category.name %>
        <%# } else { %>
        --
        <%# } %>
    </script>
@endif
@if (array_get ($data, 'gender.templet') === '#genderText')
    <script type="text/html" id="genderText">
        <%# if(d.gender === 1) { %>
        <span class="layui-badge layui-bg-green">男</span>
        <%# } else if(d.gender === 2) { %>
        <span class="layui-badge layui-bg-red">女</span>
        <%# } else { %>
        <span class="layui-badge layui-bg-gray">未知</span>
        <%# } %>
    </script>
@endif