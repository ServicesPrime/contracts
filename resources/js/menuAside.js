import {
    mdiAccountCircle,
    mdiMonitor,
    mdiCogOutline, 
    mdiAccountBox,
    mdiToolboxOutline,
} from "@mdi/js";

export default [
    {
        route: "dashboard",
        icon: mdiMonitor,
        label: "Inicio",
        to: "/dashboard",
    },
    

    {
        route: "profile.edit",
        label: "Perfil",
        icon: mdiAccountCircle,
    },


    {
        route: "contracts.index",
        label: "Contratos",
        icon: mdiCogOutline ,
    },
    {
        route: "client.index",
        label: "Client",
        icon: mdiAccountBox ,
    },
        {
        route: "services.index",
        label: "Services",
        icon: mdiToolboxOutline ,
    },
     {
        isDivider: true,
    },
];
  // {
    //     label: "Seguridad",
    //     icon: mdiShieldLock,
    //     role: "Admin",
    //     permission: "modulo.seguridad",
    //     menu: [
    //         {
    //             label: "Modulos",
    //             route: "module.index",
    //             icon: mdiViewModule,
    //             permission: "module.index",
    //         },
    //         {
    //             label: "Permisos",
    //             route: "permissions.index",
    //             icon: mdiLockCheckOutline,
    //             permission: "permissions.index",
    //         },
    //         {
    //             label: "Roles",
    //             route: "perfiles.index",
    //             icon: mdiAccountSupervisor,
    //             permission: "perfiles.index",
    //         },
    //         {
    //             label: "Usuarios",
    //             route: "user.index",
    //             icon: mdiAccount,
    //             permission: "user.index",
    //         },
    //     ],
    // },