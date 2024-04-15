const token = $('meta[name="csrf-token"]').attr("content");
const baseUrl = window.location.origin;
let pond;

$(() => {
    // Activity Logs
    // if (window.location.href === route("city_staff.activity.index")) {
    //     const activitylog_data = [
    //            {
    //     data: "id",
    //     render(data, type, row) {
    //         return row.DT_RowIndex;
    //     },
    // },
    //         { data: "description" },
    //         {
    //             data: "created_at",
    //             render(data) {
    //                 return formatDate(data, "datetime");
    //             },
    //         },
    //         { data: "actions", orderable: false, searchable: false },
    //     ];
    //     c_index(
    //         $(".activitylog_dt"),
    //         route("city_staff.activity.index"),
    //         activitylog_data
    //     );
    // }

    // Gasoline Price
    if (window.location.href === route("staff.gasoline_fees.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "gasoline_station.name" },
            { data: "type" },
            { data: "price" },

            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index(
            $(".gasoline_fee_dt"),
            route("staff.gasoline_fees.index"),
            columns
        );
    }

    // Service
    if (window.location.href === route("staff.services.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "gasoline_station.name" },
            { data: "service" },

            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".service_dt"), route("staff.services.index"), columns);
    }
});

//=========================================================
// Custom Functions()
