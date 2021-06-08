<template>
    <vs-row>
        <div class="vx-col md:w-1/1 w-full mb-base">
            <vx-card title="Control de Gasto">
                <div class="vx-row mb-4">
                    <div class="vx-col w-full mt-5">
                        <vx-card>
                            <h5 align="center">{{ dataTM }}</h5>
                        </vx-card>
                        <br />
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <vx-card>
                            <h5 align="center">ID {{ dataLic }}</h5>
                        </vx-card>
                        <br />
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <vx-card>
                            <h5 align="center">Cuota 36 de 36</h5>
                        </vx-card>
                        <br />
                    </div>

                    <div class="vx-col w-full mt-5">
                        <h4>Filtrar por Tipo de Mantencion:</h4>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionTipoMantencion"
                            v-model="seleccionTipoMantencion"
                            :options="listadoTipoMantencion"
                            @input="filtroTM()"
                        ></v-select>
                    </div>
                </div>
            </vx-card>
            <br />
            <vx-card>
                <vue-good-table
                    :columns="columns"
                    :rows="listadoART"
                    :search-options="{
                        enabled: true
                    }"
                    :pagination-options="{
                        enabled: true,
                        perPage: pageLength
                    }"
                    @on-row-click="onRowClick"
                >
                    <template slot="table-row" slot-scope="props">
                        <!-- Column: Name -->
                        <span
                            v-if="props.column.field === 'fullName'"
                            class="text-nowrap"
                        >
                        </span>

                        <!-- Column: Action -->
                        <span v-else-if="props.column.field === 'action'">
                        </span>

                        <!-- Column: Common -->
                        <span v-else>
                            {{ props.formattedRow[props.column.field] }}
                        </span>
                    </template>
                </vue-good-table>
            </vx-card>
            <vx-card>
                <vue-good-table
                    :columns="colum"
                    :rows="listadoTotalART"
                    :search-options="{
                        enabled: true
                    }"
                    :pagination-options="{
                        enabled: true,
                        perPage: pageLength
                    }"
                >
                    <template slot="table-row" slot-scope="props">
                        <!-- Column: Name -->
                        <span
                            v-if="props.column.field === 'fullName'"
                            class="text-nowrap"
                        >
                        </span>

                        <!-- Column: Action -->

                        <!-- Column: Common -->
                        <span v-else>
                            {{ props.formattedRow[props.column.field] }}
                        </span>
                    </template>
                </vue-good-table>
            </vx-card>
            <vx-card title="">
                <div class="vx-row mb-4">
                    <div class="vx-col w-1/3 mt-5">
                        <br />
                    </div>
                    <div class="vx-col w-1/3 mt-5">
                        <vs-button
                            class="fixedHeight w-full"
                            color="primary"
                            @click="volverPA"
                            >Volver</vs-button
                        >
                        <br />
                    </div>
                    <div class="vx-col w-1/3 mt-5">
                        <h3 align="center"></h3>
                        <br />
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
import { UploadCloudIcon } from "vue-feather-icons";
import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";
import { quillEditor } from "vue-quill-editor";
import Vue from "vue";
import Vuesax from "vuesax";
import vSelect from "vue-select";
import VxCard from "../../components/vx-card/VxCard.vue";
import Datepicker from "vuejs-datepicker";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
import moment from "moment";
import VueGoodTablePlugin from "vue-good-table";
import { validate, clean, format } from "rut.js";

// import the styles
import "vue-good-table/dist/vue-good-table.css";

Vue.use(VueGoodTablePlugin);
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
        quillEditor,
        UploadCloudIcon
    },
    data() {
        return {
            pageLength: 10,
            dir: false,
            searchTerm: "",
            dataTM: "",
            dataLic: "",
            listadoART: [],
            listadoARTData: [],
            listadoTotalART: [],
            listadoTipoMantencion: [],
            seleccionTipoMantencion: {
                id: 8,
                descripcionTipoMantencion: "Correctiva"
            },
            value1: 55,
            widthx: 55,
            heightx: 55,
            columns: [
                {
                    label: "ID",
                    field: "id",
                    type: "number"
                },
                {
                    label: "N° OC",
                    field: "descripcionOrdenCompras"
                },
                {
                    label: "Fecha O/C",
                    field: "fechaART",
                    type: "date",
                    dateInputFormat: "yyyy-MM-dd",
                    dateOutputFormat: "dd/MM/yyyy"
                },
                {
                    label: "Estado OC",
                    field: "descripcionEstado"
                },
                {
                    label: "N° Factura",
                    field: "nfactura"
                },

                {
                    label: "Fecha Factura",
                    field: "fechaFactura",
                    type: "date",
                    dateInputFormat: "yyyy-MM-dd",
                    dateOutputFormat: "dd/MM/yyyy"
                },
                {
                    label: "N° ART",
                    field: "idART"
                },
                {
                    label: "N° Cuota",
                    field: "cuotas"
                },
                {
                    label: "Monto",
                    field: "monto"
                }
            ],
            colum: [
                {
                    label: "ID",
                    field: "id",
                    type: "number"
                },
                {
                    label: "Monto",
                    field: "monto"
                },
                {
                    label: "Total Gastado (Con OC)",
                    field: "totaloc"
                },
                {
                    label: "Saldo Disponible",
                    field: "saldo"
                }
            ],
            localVal: process.env.MIX_APP_URL
        };
    },
    methods: {
        //Metodos Reusables
        volverPA() {
            router.back();
        },
        cambio(value) {
            this.widthx = value;
            this.heightx = value;
        },
        filtroTM() {
            try {
                let idTM = this.seleccionTipoMantencion.id;
                let list = JSON.parse(JSON.stringify(this.listadoARTData));
                let b = [];
                let a = 0;
                list.forEach((value, index) => {
                    a = idTM;
                    if (a == value.idTipoMantencion) {
                        b.push(value);
                    }
                });
                this.listadoART = b;

                b = [];
                a = 0;
                list.forEach((value, index) => {
                    a = idTM;
                    if (a == value.idTipoMantencion) {
                        let objeto = {
                            id: value.id,
                            montoTotal: value.monto,
                            totalOC: value.vpresupuesto - value.saldo,
                            saldoD: value.saldo
                        };
                        b.push(objeto);
                    }
                });
                this.listadoTotalART = b;
            } catch (error) {
                console.log("Error al Filtrar datos");
            }
        },
        //Fin Metodos Reusables
        //Metodos Listado
        onRowClick(params) {
            try {
                let id = params.row.id;
                let idTipoMantencion = params.row.idTipoMantencion;

                let c = JSON.parse(JSON.stringify(this.listadoARTData));
                let b = [];
                let a = 0;

                c.forEach((value, index) => {
                    a = value.id;
                    if (a == id) {
                        console.log(
                            "Total Gastado : " +
                                (value.vpresupuesto - value.saldo)
                        );
                    }
                });
            } catch (error) {
                console.log("Error al buscar datos");
            }
        },
        //Fin Metodos listado
        //Cargar datos Por Id o Licitacion
        cargaData() {
            try {
                let id = this.$route.params.id;
                let idLic = this.$route.params.idLic;
                if (idLic == null || idLic == 0 || idLic == 1 || idLic == "") {
                    axios
                        .get(this.localVal + `/api/ART/GetConGastoART/${id}`, {
                            headers: {
                                Authorization:
                                    `Bearer ` + sessionStorage.getItem("token")
                            }
                        })
                        .then(res => {
                            let data = res.data;
                            this.dataTM = data[0].detalleART;
                            this.dataLic = data[0].descripcionOrdenCompras;
                            this.listadoART = JSON.parse(JSON.stringify(data));
                            this.listadoARTData = JSON.parse(
                                JSON.stringify(data)
                            );
                        });
                } else {
                    axios
                        .get(
                            this.localVal +
                                `/api/ART/GetConGastoARTByLicitacion/${idLic}`,
                            {
                                headers: {
                                    Authorization:
                                        `Bearer ` +
                                        sessionStorage.getItem("token")
                                }
                            }
                        )
                        .then(res => {
                            let data = res.data;
                            this.dataTM = data[0].detalleART;
                            this.dataLic = data[0].codigoLicitacion;
                            this.listadoART = JSON.parse(JSON.stringify(data));
                            this.listadoARTData = JSON.parse(
                                JSON.stringify(data)
                            );
                        });
                }
            } catch (error) {
                console.log("Error Al Encontrar Datos");
            }
        },
        //Fin Carga datos por ID o Licitacion
        //Carga de datos para listado
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
        },
        //Fin carga datos para listado
        //Carga Data Total Gastado
        cargaInicialGastadoOC() {
            try {
                let id = this.$route.params.id;
                let idTipoMantencion = this.$route.params.idTipoMantencion;
                let idSegART = this.$route.params.idSegART;
                let obj = {
                    id: id,
                    idTipoMantencion: idTipoMantencion,
                    idSegART: idSegART
                };
                axios
                    .post(this.localVal + "/api/ART/GetListadoOCByTMO", obj, {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        let list = JSON.parse(JSON.stringify(res.data));
                        let c = [list];
                        this.listadoTotalART = c;
                    });
            } catch (error) {
                console.log(error);
            }
        }
    },
    created() {
        this.cargaData();
        this.cargarTipoMantencion();
        this.cargaInicialGastadoOC();
    }
};
</script>
<style lang="css">
.cuadrox {
    padding: 10px;
    background: rgb(45, 208, 129);
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgb(255, 255, 255);
    font-size: 20px;
    border-radius: 10px;
}
</style>
