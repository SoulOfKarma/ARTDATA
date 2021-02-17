<template>
    <vs-row>
        <div class="vx-col md:w-1/1 w-full mb-base">
            <vx-card title="Llenar formulario con datos existentes">
                <div class="vx-row mb-4">
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Buscar por N° ART Existente:</h6>
                        <br />
                        <vs-input class="inputx w-full"></vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Buscar por N° OC Existente:</h6>
                        <br />
                        <v-select class="w-full select-large"></v-select>
                    </div>
                </div>
            </vx-card>
            <br />
            <vx-card title="">
                <div class="vx-row mb-4">
                    <div class="vx-col w-1/3 mt-5">
                        <h6>N° ART:</h6>
                        <br />
                        <vs-input class="inputx w-full"> </vs-input>
                    </div>
                    <div class="vx-col w-1/3 mt-5">
                        <h6>Fecha ART</h6>
                        <br />
                        <flat-pickr
                            :config="configFromdateTimePicker"
                            v-model="fechaART"
                            placeholder="Fecha ART"
                            @on-change="onFromChange"
                            class="w-full"
                        />
                    </div>
                    <div class="vx-col w-1/3 mt-5">
                        <h6>Fecha Factura</h6>
                        <br />
                        <flat-pickr
                            :config="configTodateTimePicker"
                            v-model="fechaFactura"
                            placeholder="Fecha Factura"
                            @on-change="onToChange"
                            class="w-full"
                        />
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Rut Proveedor</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            v-model="seleccionProveedores"
                            label="rutProveedor"
                            :options="listadoProveedores"
                            @on-change="seleccionDescripcionProveedor"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Descripcion Proveedor:</h6>
                        <br />
                        <vs-input
                            class="inputx w-full"
                            v-model="seleccionProveedores.descripcionProveedor"
                            readonly
                        >
                        </vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Solicitante:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionSolicitante"
                            v-model="seleccionSolicitantes"
                            :options="listadoSolicitantes"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Ejecutor:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionEjecutores"
                            v-model="seleccionEjecutor"
                            :options="listadoEjecutores"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° Item Presupuestario:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="codigoItemPresupuestario"
                            v-model="seleccionItemPresupuestario"
                            :options="listadoItemPresupuestario"
                            @on-change="selecciondescripcionIP"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Descripcion Item Presupuestario:</h6>
                        <br />
                        <vs-input
                            class="inputx w-full"
                            readonly
                            v-model="
                                seleccionItemPresupuestario.descripcionItemPresupuestario
                            "
                        >
                        </vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Tipo Mantencion:</h6>
                        <br />
                        <v-select class="w-full select-large"></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Recurso:</h6>
                        <br />
                        <v-select class="w-full select-large"></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Tipo Compra:</h6>
                        <br />
                        <v-select class="w-full select-large"></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° Licitacion:</h6>
                        <br />
                        <v-select class="w-full select-large"></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Resolucion Llamados:</h6>
                        <br />
                        <v-select class="w-full select-large"></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Resolucion Adjudicacion:</h6>
                        <br />
                        <v-select class="w-full select-large"></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Resolucion Contrato:</h6>
                        <br />
                        <v-select class="w-full select-large"></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° CDP:</h6>
                        <br />
                        <v-select class="w-full select-large"></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° Orden de Compra:</h6>
                        <br />
                        <v-select class="w-full select-large"></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Resolucion Interna:</h6>
                        <br />
                        <v-select class="w-full select-large"></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° Memo</h6>
                        <br />
                        <v-select class="w-full select-large"></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Monto:</h6>
                        <br />
                        <vs-input class="inputx w-full" readonly> </vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° Factura:</h6>
                        <br />
                        <vs-input class="inputx w-full" readonly> </vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Detalle ART:</h6>
                        <br />
                        <vs-input class="inputx w-full" readonly> </vs-input>
                    </div>
                </div>
            </vx-card>
            <br />
            <vx-card title="">
                <div class="vx-row mb-4">
                    <div class="vx-col w-1/2 mt-5">
                        <vs-button class="fixedHeight w-full" color="primary"
                            >Volver</vs-button
                        >
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <vs-button class="fixedHeight w-full" color="success"
                            >Guardar</vs-button
                        >
                    </div>
                </div>
            </vx-card>
        </div>
    </vs-row>
</template>
<script>
import axios from "axios";
import router from "@/router";
import { InfoIcon } from "vue-feather-icons";
import { PlusCircleIcon } from "vue-feather-icons";
import { Trash2Icon } from "vue-feather-icons";
import { UploadIcon } from "vue-feather-icons";
import { CornerDownRightIcon } from "vue-feather-icons";
import { ArchiveIcon } from "vue-feather-icons";
import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";
import { quillEditor } from "vue-quill-editor";
import Vue from "vue";
import vSelect from "vue-select";
import VxCard from "../../components/vx-card/VxCard.vue";
import Datepicker from "vuejs-datepicker";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
import moment from "moment";
export default {
    components: {
        ArchiveIcon,
        InfoIcon,
        PlusCircleIcon,
        Trash2Icon,
        UploadIcon,
        CornerDownRightIcon,
        flatPickr,
        "v-select": vSelect,
        quillEditor
    },

    data() {
        return {
            fechaART: new Date(),
            fechaFactura: new Date(),
            configFromdateTimePicker: {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                        longhand: [
                            "Domingo",
                            "Lunes",
                            "Martes",
                            "Miércoles",
                            "Jueves",
                            "Viernes",
                            "Sábado"
                        ]
                    },
                    months: {
                        shorthand: [
                            "Ene",
                            "Feb",
                            "Mar",
                            "Abr",
                            "May",
                            "Jun",
                            "Jul",
                            "Ago",
                            "Sep",
                            "Оct",
                            "Nov",
                            "Dic"
                        ],
                        longhand: [
                            "Enero",
                            "Febrero",
                            "Мarzo",
                            "Abril",
                            "Mayo",
                            "Junio",
                            "Julio",
                            "Agosto",
                            "Septiembre",
                            "Octubre",
                            "Noviembre",
                            "Diciembre"
                        ]
                    }
                }
            },
            configTodateTimePicker: {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                        longhand: [
                            "Domingo",
                            "Lunes",
                            "Martes",
                            "Miércoles",
                            "Jueves",
                            "Viernes",
                            "Sábado"
                        ]
                    },
                    months: {
                        shorthand: [
                            "Ene",
                            "Feb",
                            "Mar",
                            "Abr",
                            "May",
                            "Jun",
                            "Jul",
                            "Ago",
                            "Sep",
                            "Оct",
                            "Nov",
                            "Dic"
                        ],
                        longhand: [
                            "Enero",
                            "Febrero",
                            "Мarzo",
                            "Abril",
                            "Mayo",
                            "Junio",
                            "Julio",
                            "Agosto",
                            "Septiembre",
                            "Octubre",
                            "Noviembre",
                            "Diciembre"
                        ]
                    }
                }
            },
            configdateTimePicker: {
                enableTime: true,
                enableSeconds: true,
                noCalendar: false
            },
            listadoCDP: [],
            listadoEjecutores: [],
            listadoItemPresupuestario: [],
            listadoLicitaciones: [],
            listadoMemos: [],
            listadoOrdenCompras: [],
            listadoProveedores: [],
            listadoRecursos: [],
            listadoResolucionAdjudicaciones: [],
            listadoResolucionContrato: [],
            listadoResolucionInterna: [],
            listadoResolucionLlamados: [],
            listadoSolicitantes: [],
            listadoTipoCompra: [],
            listadoTipoMantencion: [],
            seleccionCDP: {
                id: 0,
                descripcionCDPS: ""
            },
            seleccionEjecutor: {
                id: 0,
                descripcionEjecutores: ""
            },
            seleccionItemPresupuestario: {
                id: 0,
                codigoItemPresupuestario: "",
                descripcionItemPresupuestario: ""
            },
            seleccionLicitaciones: {
                id: 0,
                codigoLicitacion: ""
            },
            seleccionMemo: {
                id: 0,
                descripcionMemo: ""
            },
            seleccionOrdenCompra: {
                id: 0,
                descripcionOrdenCompras: "",
                fecha_oc: new Date(),
                idEstadoOC: 0
            },
            seleccionProveedores: {
                id: 0,
                rutProveedor: "",
                descripcionProveedor: ""
            },
            seleccionRecursos: {
                id: 0,
                descripcionRecursos: ""
            },
            seleccionResolucionAdjudicaciones: {
                id: 0,
                descripcionResAdj: ""
            },
            seleccionResolucionContrato: {
                id: 0,
                descripcionResContratos: ""
            },
            seleccionResolucionInterna: {
                id: 0,
                descripcionResInternas: ""
            },
            seleccionResolucionLlamado: {
                id: 0,
                descripcionResLlamados: ""
            },
            seleccionSolicitantes: {
                id: 0,
                descripcionSolicitante: ""
            },
            seleccionTipoCompra: {
                id: 0,
                descripcionTipoCompra: ""
            },
            seleccionTipoMantencion: {
                id: 0,
                descripcionTipoMantencion: ""
            },
            localVal: process.env.MIX_APP_URL
        };
    },
    methods: {
        limpiar() {},
        //Seleccion de fechas
        onFromChange(selectedDates, dateStr, instance) {
            this.$set(this.configTodateTimePicker, dateStr);
        },
        //Seleccion de fechas
        onToChange(selectedDates, dateStr, instance) {
            this.$set(this.configFromdateTimePicker, dateStr);
        },
        seleccionDescripcionProveedor() {
            try {
                let list = JSON.parse(JSON.stringify(this.listadoProveedores));
                let a = this.seleccionProveedores.rutProveedor;
                list.forEach((value, index) => {
                    if (a == value.rutProveedor) {
                        this.seleccionProveedores.descripcionProveedor =
                            value.descripcionProveedor;
                    }
                });
            } catch (error) {
                console.log(error);
            }
        },
        selecciondescripcionIP() {
            try {
                let list = JSON.parse(
                    JSON.stringify(this.listadoItemPresupuestario)
                );
                let a = this.seleccionItemPresupuestario
                    .codigoItemPresupuestario;
                list.forEach((value, index) => {
                    if (a == value.codigoItemPresupuestario) {
                        this.seleccionItemPresupuestario.descripcionItemPresupuestario =
                            value.descripcionItemPresupuestario;
                    }
                });
            } catch (error) {
                console.log(error);
            }
        },
        cargarCDP() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetCDP", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoCDP = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarEjecutores() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetEjecutores", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoEjecutores = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarItemPresupuestario() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetItemPresupuestario", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoItemPresupuestario = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarLicitaciones() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetLicitaciones", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoLicitaciones = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarMemos() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetMemos", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoMemos = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarOrdenCompras() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetOrdenCompras", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoOrdenCompras = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarProveedores() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetProveedores", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoProveedores = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarRecursos() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetRecursos", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoRecursos = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarResolucionAdjudicaciones() {
            try {
                axios
                    .get(
                        this.localVal + "/api/ART/GetResolucionAdjudicaciones",
                        {
                            headers: {
                                Authorization:
                                    `Bearer ` + sessionStorage.getItem("token")
                            }
                        }
                    )
                    .then(res => {
                        this.listadoResolucionAdjudicaciones = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarResolucionContrato() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetResolucionContratos", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoResolucionContrato = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarResolucionInterna() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetResolucionInternas", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoResolucionInterna = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarResolucionLlamado() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetResolucionLlamados", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoResolucionLlamados = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarSolicitantes() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetSolicitantes", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoSolicitantes = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarTipoCompra() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetTipoCompras", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoTipoCompra = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarTipoMantencion() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetTipoMantenciones", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoTipoMantencion = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        }
    },
    created: function() {
        this.cargarCDP();
        this.cargarEjecutores();
        this.cargarItemPresupuestario();
        this.cargarLicitaciones();
        this.cargarMemos();
        this.cargarOrdenCompras();
        this.cargarProveedores();
        this.cargarRecursos();
        this.cargarResolucionAdjudicaciones();
        this.cargarResolucionContrato();
        this.cargarResolucionInterna();
        this.cargarResolucionLlamado();
        this.cargarSolicitantes();
        this.cargarTipoCompra();
        this.cargarTipoMantencion();
    }
};
</script>
