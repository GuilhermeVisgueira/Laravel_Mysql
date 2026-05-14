import { useState, useEffect, useCallback, useRef } from "react";

const BASE_URL = "http://192.168.0.193:8000/api";

const API = {
  escola:       { list: "/escolas",           id: (i) => `/escolas/${i}` },
  turma:        { list: "/turma",             id: (i) => `/turma/${i}` },
  aluno:        { list: "/aluno",             id: (i) => `/aluno/${i}` },
  funcionario:  { list: "/funcionario",       id: (i) => `/funcionario/${i}` },
  funcao:       { list: "/funcao",            id: (i) => `/funcao/${i}` },
  disciplina:   { list: "/disciplina",        id: (i) => `/disciplina/${i}` },
  aula:         { list: "/aula",             id: (i) => `/aula/${i}` },
  avaliacao:    { list: "/av",               id: (i) => `/av/${i}` },
  nota:         { list: "/nota",             id: (i) => `/nota/${i}` },
  escola_func:  { list: "/Escola_Funcionario", id: (i) => `/Escola_Funcionario/${i}` },
};

async function req(method, path, body, signal) {
  // Laravel sometimes drops PUT body when sent as JSON.
  // Use POST + _method spoofing so the controller always receives the payload.
  const isUpdate = method === "PUT" || method === "PATCH";
  const fetchMethod = isUpdate ? "POST" : method;
  const payload = isUpdate && body ? { ...body, _method: method } : body;

  const res = await fetch(BASE_URL + path, {
    method: fetchMethod,
    headers: { "Content-Type": "application/json", Accept: "application/json" },
    body: payload ? JSON.stringify(payload) : undefined,
    signal,
  });
  if (!res.ok) throw new Error(`HTTP ${res.status}`);
  if (method === "DELETE") return null;
  return res.json();
}

const MODULES = [
  {
    key: "escola",
    label: "Escolas",
    icon: "🏫",
    color: "#6366f1",
    fields: [{ name: "nome_escola", label: "Nome da Escola", type: "text", required: true }],
    api: API.escola,
    display: (r) => r.nome_escola,
  },
  {
    key: "turma",
    label: "Turmas",
    icon: "📚",
    color: "#0ea5e9",
    fields: [
      { name: "descricao",    label: "Descrição", type: "text", required: true },
      { name: "turma_escola", label: "Escola",    type: "select", optionsApi: API.escola.list, optionLabel: (r) => r.nome_escola || `ID ${r.id}` },
      { name: "turma_aula",   label: "Aula",      type: "select", optionsApi: API.aula.list,   optionLabel: (r) => `Aula #${r.id}` },
    ],
    resolveColumns: {
      turma_escola: { api: API.escola.list, label: (r) => r.nome_escola || `ID ${r.id}`, colHeader: "Escola" },
      turma_aula:   { api: API.aula.list,   label: (r) => `Aula #${r.id}`,               colHeader: "Aula"   },
    },
    api: API.turma,
    display: (r) => r.descricao,
  },
  {
    key: "aluno",
    label: "Alunos",
    icon: "🎓",
    color: "#10b981",
    fields: [
      { name: "nome",         label: "Nome",      type: "text",   required: true },
      { name: "matricula",    label: "Matrícula", type: "number", required: true },
      { name: "aluno_escola", label: "Escola",    type: "select", optionsApi: API.escola.list, optionLabel: (r) => r.nome_escola || `ID ${r.id}` },
      { name: "aluno_turma",  label: "Turma",     type: "select", optionsApi: API.turma.list,  optionLabel: (r) => r.descricao   || `ID ${r.id}` },
    ],
    resolveColumns: {
      aluno_escola: { api: API.escola.list, label: (r) => r.nome_escola || `ID ${r.id}`, colHeader: "Escola" },
      aluno_turma:  { api: API.turma.list,  label: (r) => r.descricao   || `ID ${r.id}`, colHeader: "Turma"  },
    },
    api: API.aluno,
    display: (r) => r.nome,
  },
  {
    key: "funcionario",
    label: "Funcionários",
    icon: "👤",
    color: "#f59e0b",
    fields: [
      { name: "nome",      label: "Nome",         type: "text" },
      { name: "pessoal",   label: "Info Pessoal", type: "text" },
      { name: "funcao_id", label: "Função",        type: "select", optionsApi: API.funcao.list, optionLabel: (r) => r.descricao || `ID ${r.id}` },
    ],
    resolveColumns: {
      funcao_id: { api: API.funcao.list, label: (r) => r.descricao || `ID ${r.id}`, colHeader: "Função" },
    },
    api: API.funcionario,
    display: (r) => r.nome || `ID ${r.id}`,
  },
  {
    key: "funcao",
    label: "Funções",
    icon: "🏷️",
    color: "#ec4899",
    fields: [{ name: "descricao", label: "Descrição", type: "text" }],
    api: API.funcao,
    display: (r) => r.descricao || `ID ${r.id}`,
  },
  {
    key: "disciplina",
    label: "Disciplinas",
    icon: "📖",
    color: "#8b5cf6",
    fields: [{ name: "nome", label: "Nome", type: "text" }],
    api: API.disciplina,
    display: (r) => r.nome || `ID ${r.id}`,
  },
  {
    key: "aula",
    label: "Aulas",
    icon: "🗒️",
    color: "#14b8a6",
    fields: [
      { name: "aula_disciplina",  label: "Disciplina",           type: "select", optionsApi: API.disciplina.list,  optionLabel: (r) => r.nome || `ID ${r.id}` },
      { name: "funcionario_aula", label: "Funcionário (Prof.)",  type: "select", optionsApi: API.funcionario.list, optionLabel: (r) => r.nome || `ID ${r.id}` },
    ],
    // used to resolve FK ids → names in the list table
    resolveColumns: {
      aula_disciplina:  { api: API.disciplina.list,  label: (r) => r.nome       || `ID ${r.id}`, colHeader: "Disciplina" },
      funcionario_aula: { api: API.funcionario.list, label: (r) => r.nome       || `ID ${r.id}`, colHeader: "Professor" },
    },
    api: API.aula,
    display: (r) => `Aula #${r.id}`,
  },
  {
    key: "avaliacao",
    label: "Avaliações",
    icon: "📝",
    color: "#f97316",
    fields: [
      { name: "avaliacao_aula", label: "Aula", type: "select", optionsApi: API.aula.list, optionLabel: (r) => `Aula #${r.id}` },
    ],
    resolveColumns: {
      avaliacao_aula: { api: API.aula.list, label: (r) => `Aula #${r.id}`, colHeader: "Aula" },
    },
    api: API.avaliacao,
    display: (r) => `Avaliação #${r.id}`,
  },
  {
    key: "nota",
    label: "Notas",
    icon: "⭐",
    color: "#eab308",
    fields: [
      { name: "nota_aluno",     label: "Aluno",     type: "select", optionsApi: API.aluno.list,     optionLabel: (r) => r.nome || `ID ${r.id}` },
      { name: "nota_avaliacao", label: "Avaliação", type: "select", optionsApi: API.avaliacao.list, optionLabel: (r) => `Avaliação #${r.id}` },
    ],
    resolveColumns: {
      nota_aluno:     { api: API.aluno.list,     label: (r) => r.nome || `ID ${r.id}`, colHeader: "Aluno" },
      nota_avaliacao: { api: API.avaliacao.list, label: (r) => `Avaliação #${r.id}`,   colHeader: "Avaliação" },
    },
    api: API.nota,
    display: (r) => `Nota #${r.id}`,
  },
  {
    key: "escola_func",
    label: "Escola × Func.",
    icon: "🔗",
    color: "#06b6d4",
    fields: [
      { name: "funcionario_id", label: "Funcionário", type: "select", optionsApi: API.funcionario.list, optionLabel: (r) => r.nome        || `ID ${r.id}` },
      { name: "escola_id",      label: "Escola",      type: "select", optionsApi: API.escola.list,      optionLabel: (r) => r.nome_escola || `ID ${r.id}` },
    ],
    resolveColumns: {
      funcionario_id: { api: API.funcionario.list, label: (r) => r.nome        || `ID ${r.id}`, colHeader: "Funcionário" },
      escola_id:      { api: API.escola.list,      label: (r) => r.nome_escola || `ID ${r.id}`, colHeader: "Escola" },
    },
    api: API.escola_func,
    display: (r) => `Vínculo #${r.id}`,
  },
];

function Toast({ msg, type, onClose }) {
  useEffect(() => {
    const t = setTimeout(onClose, 3200);
    return () => clearTimeout(t);
  }, [onClose]);
  const bg = type === "error" ? "#ef4444" : "#10b981";
  return (
    <div style={{
      position: "fixed", bottom: 24, right: 24, zIndex: 9999,
      background: bg, color: "#fff", padding: "12px 20px",
      borderRadius: 10, fontSize: 14, fontWeight: 500,
      boxShadow: "0 8px 24px rgba(0,0,0,.25)",
      animation: "slideUp .25s ease",
    }}>{msg}</div>
  );
}

function Modal({ title, onClose, children }) {
  return (
    <div style={{
      position: "fixed", inset: 0, background: "rgba(0,0,0,.55)",
      display: "flex", alignItems: "center", justifyContent: "center", zIndex: 1000,
    }} onClick={onClose}>
      <div style={{
        background: "#1e1e2e", borderRadius: 16, padding: "28px 32px",
        minWidth: 340, maxWidth: 480, width: "100%",
        boxShadow: "0 24px 64px rgba(0,0,0,.5)",
        border: "1px solid rgba(255,255,255,.08)",
      }} onClick={(e) => e.stopPropagation()}>
        <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center", marginBottom: 20 }}>
          <h3 style={{ margin: 0, color: "#e2e8f0", fontSize: 18, fontWeight: 600 }}>{title}</h3>
          <button onClick={onClose} style={{ background: "none", border: "none", color: "#94a3b8", cursor: "pointer", fontSize: 20, lineHeight: 1 }}>×</button>
        </div>
        {children}
      </div>
    </div>
  );
}

function SelectField({ field, value, onChange, options, loadingOptions }) {
  const selectStyle = {
    width: "100%", boxSizing: "border-box",
    background: "#0f0f1a", border: "1px solid rgba(255,255,255,.12)",
    borderRadius: 8, padding: "9px 12px", color: "#e2e8f0",
    fontSize: 14, outline: "none", appearance: "none",
    backgroundImage: `url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394a3b8' d='M6 8L1 3h10z'/%3E%3C/svg%3E")`,
    backgroundRepeat: "no-repeat", backgroundPosition: "right 12px center",
    cursor: "pointer",
  };
  return (
    <div style={{ marginBottom: 14 }}>
      <label style={{ display: "block", fontSize: 12, color: "#94a3b8", marginBottom: 6, fontWeight: 500, letterSpacing: ".04em", textTransform: "uppercase" }}>
        {field.label}{field.required && <span style={{ color: "#f87171" }}> *</span>}
      </label>
      <select
        value={value ?? ""}
        onChange={(e) => onChange(field.name, e.target.value === "" ? "" : Number(e.target.value))}
        disabled={loadingOptions}
        style={selectStyle}
      >
        <option value="">{loadingOptions ? "Carregando…" : "— Nenhum —"}</option>
        {options.map((opt) => (
          <option key={opt.id} value={opt.id}>{opt._label}</option>
        ))}
      </select>
    </div>
  );
}

function FormField({ field, value, onChange }) {
  return (
    <div style={{ marginBottom: 14 }}>
      <label style={{ display: "block", fontSize: 12, color: "#94a3b8", marginBottom: 6, fontWeight: 500, letterSpacing: ".04em", textTransform: "uppercase" }}>
        {field.label}{field.required && <span style={{ color: "#f87171" }}> *</span>}
      </label>
      <input
        type={field.type}
        value={value ?? ""}
        onChange={(e) => onChange(field.name, field.type === "number" ? (e.target.value === "" ? "" : Number(e.target.value)) : e.target.value)}
        style={{
          width: "100%", boxSizing: "border-box",
          background: "#0f0f1a", border: "1px solid rgba(255,255,255,.12)",
          borderRadius: 8, padding: "9px 12px", color: "#e2e8f0",
          fontSize: 14, outline: "none",
        }}
      />
    </div>
  );
}

function RecordForm({ module, initial, onSubmit, onCancel, loading }) {
  const [form, setForm] = useState(() => {
    const base = {};
    module.fields.forEach((f) => {
      const raw = initial?.[f.name];
      // Coerce FK select values to Number so <select> finds the right option
      if (f.type === "select") {
        base[f.name] = (raw != null && raw !== "") ? Number(raw) : "";
      } else {
        base[f.name] = raw ?? "";
      }
    });
    return base;
  });
  const [selectOptions,  setSelectOptions]  = useState({});
  const [loadingOptions, setLoadingOptions] = useState({});

  useEffect(() => {
    module.fields.forEach(async (f) => {
      if (f.type !== "select") return;
      setLoadingOptions((p) => ({ ...p, [f.name]: true }));
      try {
        const data = await req("GET", f.optionsApi);
        const list = Array.isArray(data) ? data : data?.data ?? [];
        setSelectOptions((p) => ({
          ...p,
          [f.name]: list.map((r) => ({ id: r.id, _label: f.optionLabel(r) })),
        }));
      } catch {
        setSelectOptions((p) => ({ ...p, [f.name]: [] }));
      } finally {
        setLoadingOptions((p) => ({ ...p, [f.name]: false }));
      }
    });
  }, [module]);

  const set = (k, v) => setForm((p) => ({ ...p, [k]: v }));

  const handleSubmit = () => {
    const payload = {};
    module.fields.forEach((f) => {
      // Only skip truly unset fields (empty string = "not chosen")
      // Include 0, false, and any other value the user selected
      if (form[f.name] !== "") payload[f.name] = form[f.name];
    });
    onSubmit(payload);
  };

  return (
    <div>
      {module.fields.map((f) =>
        f.type === "select" ? (
          <SelectField
            key={f.name}
            field={f}
            value={form[f.name]}
            onChange={set}
            options={selectOptions[f.name] ?? []}
            loadingOptions={!!loadingOptions[f.name]}
          />
        ) : (
          <FormField key={f.name} field={f} value={form[f.name]} onChange={set} />
        )
      )}
      <div style={{ display: "flex", gap: 10, marginTop: 20 }}>
        <button onClick={handleSubmit} disabled={loading} style={{
          flex: 1, background: module.color, color: "#fff", border: "none",
          borderRadius: 8, padding: "10px 0", fontWeight: 600, cursor: "pointer",
          fontSize: 14, opacity: loading ? .6 : 1,
        }}>
          {loading ? "Salvando…" : initial ? "Salvar alterações" : "Criar"}
        </button>
        <button onClick={onCancel} style={{
          flex: 1, background: "rgba(255,255,255,.06)", color: "#94a3b8",
          border: "1px solid rgba(255,255,255,.1)", borderRadius: 8,
          padding: "10px 0", fontWeight: 500, cursor: "pointer", fontSize: 14,
        }}>Cancelar</button>
      </div>
    </div>
  );
}

function RecordRow({ record, module, lookups, onEdit, onDelete }) {
  const [confirm, setConfirm] = useState(false);
  const rc   = module.resolveColumns ?? {};
  const cols = Object.entries(record).filter(([k]) => !["created_at","updated_at","deleted_at"].includes(k));

  const displayVal = (k, v) => {
    if (v == null) return <span style={{ fontStyle: "italic", color: "#4b5563" }}>null</span>;
    // If this column has a lookup map, show the resolved name
    if (rc[k] && lookups[k]) {
      const resolved = lookups[k][v];
      return resolved ?? String(v);
    }
    return String(v);
  };

  return (
    <tr style={{ borderBottom: "1px solid rgba(255,255,255,.05)" }}>
      {cols.map(([k, v]) => (
        <td key={k} style={{ padding: "10px 14px", fontSize: 13, color: "#cbd5e1", maxWidth: 180, overflow: "hidden", textOverflow: "ellipsis", whiteSpace: "nowrap" }}>
          {displayVal(k, v)}
        </td>
      ))}
      <td style={{ padding: "10px 14px", whiteSpace: "nowrap" }}>
        <button onClick={() => onEdit(record)} style={{ background: "rgba(255,255,255,.07)", border: "none", color: "#93c5fd", borderRadius: 6, padding: "4px 12px", fontSize: 12, cursor: "pointer", marginRight: 6 }}>Editar</button>
        {confirm
          ? <>
              <button onClick={() => onDelete(record.id)} style={{ background: "#ef4444", border: "none", color: "#fff", borderRadius: 6, padding: "4px 12px", fontSize: 12, cursor: "pointer", marginRight: 4 }}>Confirmar</button>
              <button onClick={() => setConfirm(false)} style={{ background: "transparent", border: "none", color: "#6b7280", fontSize: 12, cursor: "pointer" }}>Cancelar</button>
            </>
          : <button onClick={() => setConfirm(true)} style={{ background: "rgba(239,68,68,.12)", border: "none", color: "#f87171", borderRadius: 6, padding: "4px 12px", fontSize: 12, cursor: "pointer" }}>Excluir</button>
        }
      </td>
    </tr>
  );
}

function ModuleView({ module, toast }) {
  const [records, setRecords]   = useState([]);
  const [loading, setLoading]   = useState(true);
  const [saving,  setSaving]    = useState(false);
  const [modal,   setModal]     = useState(null);
  const [search,  setSearch]    = useState("");
  // lookup maps: { columnKey: { id: label } }
  const [lookups, setLookups]   = useState({});
  // guard against React 18 StrictMode double-invoke
  const loadingRef = useRef(false);

  const load = useCallback(async () => {
    if (loadingRef.current) return;
    loadingRef.current = true;
    setLoading(true);
    try {
      const data = await req("GET", module.api.list);
      setRecords(Array.isArray(data) ? data : data?.data ?? []);
    } catch (e) {
      toast("Erro ao carregar dados: " + e.message, "error");
    } finally {
      setLoading(false);
      loadingRef.current = false;
    }
  }, [module]);  // eslint-disable-line

  // Load lookup maps for columns that need name resolution
  useEffect(() => {
    const rc = module.resolveColumns;
    if (!rc) return;
    let cancelled = false;
    (async () => {
      const entries = await Promise.all(
        Object.entries(rc).map(async ([col, cfg]) => {
          try {
            const data = await req("GET", cfg.api);
            const list = Array.isArray(data) ? data : data?.data ?? [];
            const map  = {};
            list.forEach((r) => { map[r.id] = cfg.label(r); });
            return [col, map];
          } catch { return [col, {}]; }
        })
      );
      if (!cancelled) setLookups(Object.fromEntries(entries));
    })();
    return () => { cancelled = true; };
  }, [module]);

  useEffect(() => { loadingRef.current = false; load(); }, [load]);

  const handleCreate = async (payload) => {
    setSaving(true);
    try {
      await req("POST", module.api.list, payload);
      toast("Criado com sucesso!", "success");
      setModal(null);
      load();
    } catch (e) { toast("Erro ao criar: " + e.message, "error"); }
    finally { setSaving(false); }
  };

  const handleUpdate = async (payload) => {
    // Capture the id immediately — avoids stale closure if modal closes before async finishes
    const recordId = modal?.record?.id;
    if (!recordId) { toast("ID do registro não encontrado.", "error"); return; }
    setSaving(true);
    try {
      await req("PUT", module.api.id(recordId), payload);
      toast("Atualizado com sucesso!", "success");
      setModal(null);
      load();
    } catch (e) { toast("Erro ao atualizar: " + e.message, "error"); }
    finally { setSaving(false); }
  };

  const handleDelete = async (id) => {
    try {
      await req("DELETE", module.api.id(id));
      toast("Excluído com sucesso!", "success");
      load();
    } catch (e) { toast("Erro: " + e.message, "error"); }
  };

  const filtered = records.filter((r) =>
    search === "" || JSON.stringify(r).toLowerCase().includes(search.toLowerCase())
  );

  const rc   = module.resolveColumns ?? {};
  const cols = records[0]
    ? Object.keys(records[0]).filter((k) => !["created_at","updated_at","deleted_at"].includes(k))
    : [];

  // Header label: use resolveColumns colHeader if defined, else raw key
  const colHeader = (k) => rc[k]?.colHeader ?? k;

  return (
    <div style={{ padding: "28px 32px" }}>
      <div style={{ display: "flex", alignItems: "center", gap: 16, marginBottom: 24 }}>
        <span style={{ fontSize: 28 }}>{module.icon}</span>
        <h2 style={{ margin: 0, fontSize: 22, fontWeight: 700, color: "#f1f5f9" }}>{module.label}</h2>
        <div style={{ flex: 1 }} />
        <input
          placeholder="Buscar…"
          value={search}
          onChange={(e) => setSearch(e.target.value)}
          style={{
            background: "rgba(255,255,255,.06)", border: "1px solid rgba(255,255,255,.1)",
            borderRadius: 8, padding: "8px 14px", color: "#e2e8f0", fontSize: 13, outline: "none", width: 200,
          }}
        />
        {module.fields.length > 0 && (
          <button onClick={() => setModal({ mode: "create" })} style={{
            background: module.color, color: "#fff", border: "none",
            borderRadius: 8, padding: "9px 20px", fontWeight: 600, cursor: "pointer", fontSize: 14,
            display: "flex", alignItems: "center", gap: 6,
          }}>
            + Novo
          </button>
        )}
      </div>

      {loading ? (
        <div style={{ textAlign: "center", padding: 60, color: "#4b5563" }}>Carregando…</div>
      ) : filtered.length === 0 ? (
        <div style={{ textAlign: "center", padding: 60, color: "#4b5563", fontSize: 14 }}>
          {search ? "Nenhum resultado encontrado." : "Nenhum registro encontrado."}
        </div>
      ) : (
        <div style={{ overflowX: "auto", borderRadius: 12, border: "1px solid rgba(255,255,255,.07)" }}>
          <table style={{ width: "100%", borderCollapse: "collapse" }}>
            <thead>
              <tr style={{ background: "rgba(255,255,255,.04)" }}>
                {cols.map((c) => (
                  <th key={c} style={{ padding: "10px 14px", textAlign: "left", fontSize: 11, color: "#64748b", fontWeight: 600, letterSpacing: ".06em", textTransform: "uppercase", whiteSpace: "nowrap" }}>
                    {colHeader(c)}
                  </th>
                ))}
                <th style={{ padding: "10px 14px", fontSize: 11, color: "#64748b", fontWeight: 600, letterSpacing: ".06em", textTransform: "uppercase" }}>Ações</th>
              </tr>
            </thead>
            <tbody>
              {filtered.map((r) => (
                <RecordRow key={r.id} record={r} module={module} lookups={lookups}
                  onEdit={(rec) => setModal({ mode: "edit", record: rec })}
                  onDelete={handleDelete}
                />
              ))}
            </tbody>
          </table>
        </div>
      )}

      <div style={{ marginTop: 12, fontSize: 12, color: "#374151" }}>
        {filtered.length} registro{filtered.length !== 1 ? "s" : ""}
        {search && ` de ${records.length}`}
      </div>

      {modal && (
        <Modal
          title={modal.mode === "create" ? `Novo ${module.label.slice(0,-1)}` : `Editar ${module.display(modal.record)}`}
          onClose={() => setModal(null)}
        >
          <RecordForm
            module={module}
            initial={modal.record}
            onSubmit={modal.mode === "create" ? handleCreate : handleUpdate}
            onCancel={() => setModal(null)}
            loading={saving}
          />
        </Modal>
      )}
    </div>
  );
}

export default function App() {
  const [active, setActive] = useState("escola");
  const [toasts, setToasts] = useState([]);

  const addToast = (msg, type = "success") => {
    const id = Date.now();
    setToasts((p) => [...p, { id, msg, type }]);
  };
  const removeToast = (id) => setToasts((p) => p.filter((t) => t.id !== id));

  const module = MODULES.find((m) => m.key === active);

  return (
    <div style={{ display: "flex", minHeight: "100vh", background: "#0b0b16", fontFamily: "'Inter', 'Segoe UI', sans-serif" }}>
      <style>{`
        @keyframes slideUp { from { transform: translateY(16px); opacity:0 } to { transform: translateY(0); opacity:1 } }
        * { box-sizing: border-box; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 4px; }
        input::placeholder { color: #374151; }
        tr:hover td { background: rgba(255,255,255,.02); }
      `}</style>

      {/* Sidebar */}
      <div style={{
        width: 220, background: "#111120", borderRight: "1px solid rgba(255,255,255,.07)",
        display: "flex", flexDirection: "column", flexShrink: 0,
      }}>
        <div style={{ padding: "24px 20px 20px", borderBottom: "1px solid rgba(255,255,255,.07)" }}>
          <div style={{ fontSize: 18, fontWeight: 800, color: "#f1f5f9", letterSpacing: "-.02em" }}>🏫 EscolaApp</div>
          <div style={{ fontSize: 11, color: "#374151", marginTop: 3, letterSpacing: ".04em" }}>PAINEL ADMINISTRATIVO</div>
        </div>
        <nav style={{ flex: 1, padding: "12px 10px", overflowY: "auto" }}>
          {MODULES.map((m) => {
            const isActive = m.key === active;
            return (
              <button key={m.key} onClick={() => setActive(m.key)} style={{
                width: "100%", display: "flex", alignItems: "center", gap: 10,
                padding: "9px 12px", borderRadius: 8, border: "none", cursor: "pointer",
                background: isActive ? `${m.color}22` : "transparent",
                color: isActive ? m.color : "#6b7280",
                fontSize: 13, fontWeight: isActive ? 600 : 400,
                marginBottom: 2, textAlign: "left",
                transition: "all .15s",
                borderLeft: isActive ? `3px solid ${m.color}` : "3px solid transparent",
              }}>
                <span style={{ fontSize: 16 }}>{m.icon}</span>
                {m.label}
              </button>
            );
          })}
        </nav>
        <div style={{ padding: "14px 20px", borderTop: "1px solid rgba(255,255,255,.07)", fontSize: 11, color: "#1f2937" }}>
          API: localhost
        </div>
      </div>

      {/* Main */}
      <div style={{ flex: 1, overflowY: "auto" }}>
        <ModuleView key={active} module={module} toast={addToast} />
      </div>

      {toasts.map((t) => (
        <Toast key={t.id} msg={t.msg} type={t.type} onClose={() => removeToast(t.id)} />
      ))}
    </div>
  );
}
