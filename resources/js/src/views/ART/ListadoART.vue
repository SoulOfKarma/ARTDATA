<template>
    <vs-row>
        <div class="vx-col md:w-1/1 w-full mb-base">
            <vx-card title="Listado Seguimiento ART">
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
                            <info-icon
                                size="1.5x"
                                class="custom-class"
                                @click="
                                    ControlGArt(
                                        props.row.id,
                                        props.row.idLicitacion,
                                        props.row.idSegART,
                                        props.row.idTipoMantencion
                                    )
                                "
                            ></info-icon>
                            <upload-icon
                                size="1.5x"
                                class="custom-class"
                                @click="informacionART(props.row.id)"
                            ></upload-icon>
                            <trash-2-icon
                                size="1.5x"
                                class="custom-class"
                                @click="quitarItem(props.row.id)"
                            ></trash-2-icon>
                        </span>

                        <!-- Column: Common -->
                        <span v-else>
                            {{ props.formattedRow[props.column.field] }}
                        </span>
                    </template>
                </vue-good-table>
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
            fileName: "",
            listadoART: [],
            editorOption: {
                modules: {
                    toolbar: [
                        ["bold", "italic", "underline", "strike"],
                        ["blockquote", "code-block"],
                        [{ header: 1 }, { header: 2 }],
                        [{ list: "ordered" }, { list: "bullet" }],
                        [{ indent: "-1" }, { indent: "+1" }],
                        [{ direction: "rtl" }],
                        [{ font: [] }],
                        [{ align: [] }],
                        ["clean"]
                    ]
                }
            },
            columns: [
                {
                    label: "ID",
                    field: "id",
                    type: "number"
                },
                {
                    label: "ID ART",
                    field: "idART"
                },
                {
                    label: "Rut Proveedor",
                    field: "rutProveedor"
                },
                {
                    label: "Descripcion Proveedor",
                    field: "descripcionProveedor"
                },
                {
                    label: "Monto",
                    field: "monto",
                    type: "number"
                },

                {
                    label: "N° Factura",
                    field: "nfactura",
                    type: "number"
                },
                {
                    label: "Solicitante",
                    field: "descripcionSolicitante"
                },
                {
                    label: "Detalle ART",
                    field: "detalleART"
                },
                {
                    label: "Fecha Emision ART",
                    field: "fechaART",
                    type: "date",
                    dateInputFormat: "yyyy-MM-dd",
                    dateOutputFormat: "dd/MM/yyyy"
                },
                {
                    label: "Fecha Factura ART",
                    field: "fechaFactura",
                    type: "date",
                    dateInputFormat: "yyyy-MM-dd",
                    dateOutputFormat: "dd/MM/yyyy"
                },
                {
                    label: "Fecha Ultima Actualizacion",
                    field: "updated_at",
                    type: "date",
                    dateInputFormat: "yyyy-MM-dd",
                    dateOutputFormat: "dd/MM/yyyy"
                },
                {
                    label: "Opciones",
                    field: "action"
                }
            ],
            popModificarART: false,
            CconfirmarModificar: false,
            localVal: process.env.MIX_APP_URL
        };
    },
    methods: {
        //Funciones
        informacionART(id) {
            try {
                this.$router.push({
                    name: "ModificarART",
                    params: {
                        id: `${id}`
                    }
                });
            } catch (error) {
                console.log("Hubo un error al tratar de dirigirse al sitio");
            }
        },
        //Funciones
        ControlGArt(id, idLic, idSegART, idTipoMantencion) {
            try {
                if (idSegART === null) {
                    this.$router.push({
                        name: "ControlGastoART",
                        params: {
                            id: `${id}`,
                            idLic: `${idLic}`,
                            idSegART: `${id}`,
                            idTipoMantencion: `${idTipoMantencion}`
                        }
                    });
                } else {
                    this.$router.push({
                        name: "ControlGastoART",
                        params: {
                            id: `${id}`,
                            idLic: `${idLic}`,
                            idSegART: `${idSegART}`,
                            idTipoMantencion: `${idTipoMantencion}`
                        }
                    });
                }
            } catch (error) {
                console.log("Hubo un error al tratar de dirigirse al sitio");
                console.log(error);
            }
        },
        quitarItem(id) {
            try {
            } catch (error) {
                console.log("Hubo un error al capturar el dato");
            }
        },
        //Carga Data
        cargarRegistros() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetRegistroART", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        let c = JSON.parse(JSON.stringify(res.data));
                        let b = [];
                        const formatter = new Intl.NumberFormat("en-US", {
                            style: "currency",
                            currency: "USD",
                            minimumFractionDigits: 0
                        });

                        c.forEach((value, index) => {
                            value.monto = formatter.format(value.monto);
                            b.push(value);
                        });
                        this.listadoART = b;
                    });
            } catch (error) {
                console.log(error);
            }
        }
    },
    created() {
        this.cargarRegistros();
    }
};
</script>
