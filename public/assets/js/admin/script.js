const token = $('meta[name="csrf-token"]').attr("content");
const baseUrl = window.location.origin;
let pond;

$(() => {
    // Activity Logs
    if (window.location.href === route("admin.activity_logs.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "description" },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "datetime");
                },
            },
            { data: "properties.ip" },
        ];
        c_index(
            $(".activitylog_dt"),
            route("admin.activity_logs.index"),
            columns,
            [[2, "desc"]]
        );
    }

    // Gasoline Station
    if (window.location.href === route("admin.gasoline_stations.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            {
                data: "featured_photo",
                render(data) {
                    return handleNullImage(data, "", 150);
                },
            },
            { data: "name" },
            { data: "address" },
            { data: "municipality" },
            { data: "latitude" },
            { data: "longitude" },
           
            {
                data: "is_always_open",
                render(data) {
                    return isAlwaysOpen(data);
                },
            },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index(
            $(".gasoline_station_dt"),
            route("admin.gasoline_stations.index"),
            columns
        );
    }

    // Gasoline Fee
    if (window.location.href === route("admin.gasoline_fees.index")) {
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
            route("admin.gasoline_fees.index"),
            columns
        );
    }

    // Service
    if (window.location.href === route("admin.services.index")) {
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
        c_index($(".service_dt"), route("admin.services.index"), columns);
    }

    // Staff
    if (window.location.href === route("admin.staffs.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "gasoline_station.name" },
            { data: "first_name" },
            { data: "middle_name" },
            { data: "last_name" },
            { data: "sex" },
            { data: "address" },
            { data: "municipality.name" },
            { data: "contact" },
            { data: "email" },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".staff_dt"), route("admin.staffs.index"), columns);
    }

    //User;
    if (window.location.href === route("admin.users.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            {
                data: "avatar",
                render(data) {
                    return handleNullAvatar(data);
                },
            },
            { data: "name" },
            {
                data: "email_verified_at",
                render(data) {
                    return isVerified(data);
                },
            },
            {
                data: "role",
                render(data) {
                    return `<span class='badge badge-primary'>${data}</span>`;
                },
            },
            {
                data: "is_activated",
                render(data) {
                    return isActivated(data);
                },
            },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data.date, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".user_dt"), route("admin.users.index"), columns);
    }
});

//=========================================================
// Custom Functions()
document.addEventListener("DOMContentLoaded", function (event) {
    // initiate global glightbox

    setTimeout(() => {
        GLightbox({
            selector: ".glightbox",
        });
    }, 1000);
});

/**
 * get all gasoline fee by gasoline station
 * @param {*} gasoline_station
 */
function filterGasolineStationByMunicipality(municipality) {
    const columns = [
        {
            data: "id",
            render(data, type, row) {
                return row.DT_RowIndex;
            },
        },
        {
            data: "featured_photo",
            render(data) {
                return handleNullImage(data, "", 150);
            },
        },
        { data: "name" },
        { data: "address" },
        { data: "municipality" },
        { data: "latitude" },
        { data: "longitude" },
       
        {
            data: "is_always_open",
            render(data) {
                return isAlwaysOpen(data);
            },
        },
        {
            data: "created_at",
            render(data) {
                return formatDate(data, "full");
            },
        },
        { data: "actions", orderable: false, searchable: false },
    ];
    c_index(
        $(".gasoline_station_dt"),
        route("admin.gasoline_stations.index", {
            municipality: municipality.value,
        }),
        columns,
        null,
        true
    );
}

/**
 * get all gasoline fee by gasoline station
 * @param {*} gasoline_station
 */
function filterGasolineFeeByGasolineStation(gasoline_station) {
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
        route("admin.gasoline_fees.index", {
            gasoline_station: gasoline_station.value,
        }),
        columns,
        null,
        true
    );
}

/**
 * get all gasoline services by gasoline station
 * @param {*} gasoline_station
 */
function filterServiceByGasolineStation(gasoline_station) {
    const columns = [
        {
            data: "id",
            render(data, type, row) {
                return row.DT_RowIndex;
            },
        },
        { data: "gasoline_station.name" },
        { data: "name" },
        {
            data: "created_at",
            render(data) {
                return formatDate(data, "full");
            },
        },
        { data: "actions", orderable: false, searchable: false },
    ];
    c_index(
        $(".service_dt"),
        route("admin.services.index", {
            gasoline_station: gasoline_station.value,
        }),
        columns,
        null,
        true
    );
}

function filterUserByRole(role) {
    const columns = [
        {
            data: "id",
            render(data, type, row) {
                return row.DT_RowIndex;
            },
        },
        {
            data: "avatar",
            render(data) {
                return handleNullAvatar(data);
            },
        },
        { data: "name" },
        {
            data: "email_verified_at",
            render(data) {
                return isVerified(data);
            },
        },
        {
            data: "role",
            render(data) {
                return `<span class='badge badge-primary'>${data}</span>`;
            },
        },
        {
            data: "is_activated",
            render(data) {
                return isActivated(data);
            },
        },
        {
            data: "created_at",
            render(data) {
                return formatDate(data.date, "full");
            },
        },
        { data: "actions", orderable: false, searchable: false },
    ];
    c_index(
        $(".user_dt"),
        route("admin.users.index", {
            role: role.value,
        }),
        columns,
        null,
        true
    );
}
