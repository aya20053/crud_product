<template>
  <div class="full-width-container">
    <div class="simple-header">
      <h1>Gestion des Produits</h1>
     
    </div>

    <div class="main-actions" v-if="!showForm && !showList">
      <div class="actions-container">
        <div class="action-card" @click="showAddForm">
          <div class="action-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
            </svg>
          </div>
          <h3>Ajouter un produit</h3>
          <p>Créer un nouveau produit dans votre catalogue</p>
        </div>
        
        <div class="action-card" @click="showProductList">
          <div class="action-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/>
              <path d="M3 9H21M9 21V9" stroke="currentColor" stroke-width="2"/>
            </svg>
          </div>
          <h3>Afficher les produits</h3>
          <p>Voir et gérer tous vos produits existants</p>
        </div>
      </div>
    </div>

    <div class="full-width-form" v-if="showForm">
      <div class="form-section">
        <div class="form-card">
          <div class="form-header">
            <h2>Nouveau produit</h2>
            <button @click="hideForm" class="close-btn">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </button>
          </div>

          <form @submit.prevent="saveProduct" class="simple-form">
            <div class="form-grid">
              <div class="form-group">
                <label>Nom du produit *</label>
                <input 
                  v-model="form.name" 
                  placeholder="Nom du produit" 
                  required 
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <label>Prix (DH) *</label>
                <input 
                  v-model="form.price" 
                  type="number" 
                  placeholder="0.00" 
                  required 
                  class="form-control"
                  step="0.01"
                  min="0"
                />
              </div>

              <div class="form-group">
                <label>Stock *</label>
                <input 
                  v-model="form.stock" 
                  type="number" 
                  placeholder="0" 
                  required 
                  class="form-control"
                  min="0"
                />
              </div>

              <div class="form-group">
                <label>Catégorie *</label>
                <input 
                  v-model="form.category" 
                  placeholder="Catégorie" 
                  required 
                  class="form-control"
                />
              </div>

              <div class="form-group full-width">
                <label>Description</label>
                <textarea 
                  v-model="form.description" 
                  placeholder="Description du produit..." 
                  rows="4"
                  class="form-control textarea"
                ></textarea>
              </div>

              <div class="form-group">
                <label>Statut du produit</label>
                <div class="status-options">
                  <label class="radio-option">
                    <input 
                      type="radio" 
                      v-model="form.is_active" 
                      :value="1"
                      class="radio-input"
                      checked
                    />
                    <span class="radio-custom"></span>
                    <span class="radio-label">
                      <span class="status-active">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle cx="12" cy="12" r="10" fill="#10B981" stroke="#10B981" stroke-width="2"/>
                          <path d="M8 12L11 15L16 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Actif
                      </span>
                    </span>
                  </label>
                  <label class="radio-option">
                    <input 
                      type="radio" 
                      v-model="form.is_active" 
                      :value="0"
                      class="radio-input"
                    />
                    <span class="radio-custom"></span>
                    <span class="radio-label">
                      <span class="status-inactive">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle cx="12" cy="12" r="10" fill="#EF4444" stroke="#EF4444" stroke-width="2"/>
                          <path d="M15 9L9 15M9 9L15 15" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        Inactif
                      </span>
                    </span>
                  </label>
                </div>
              </div>
            </div>

            <div class="form-actions">
              <button type="submit" class="btn btn-primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M19 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3H16.1716C16.702 3 17.2107 3.21071 17.5858 3.58579L20.4142 6.41421C20.7893 6.78929 21 7.29799 21 7.82843V19C21 20.1046 20.1046 21 19 21Z" stroke="currentColor" stroke-width="2"/>
                  <path d="M17 21V13H7V21" stroke="currentColor" stroke-width="2"/>
                  <path d="M7 3V8H15" stroke="currentColor" stroke-width="2"/>
                </svg>
                Enregistrer le produit
              </button>
              
              <button 
                @click="hideForm" 
                type="button" 
                class="btn btn-secondary"
              >
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Annuler
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="full-width-list" v-if="showList">
      <div class="list-header">
        <div class="header-content">
          <div class="header-main">
            <button @click="hideList" class="back-btn">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Retour
            </button>
            <h2>Liste des produits</h2>
            <button @click="showAddFormFromList" class="btn btn-primary">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
              Ajouter un produit
            </button>
          </div>
          <div class="total-count">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M9 12H15M9 16H15M9 20H15M5 4H19C20.1046 4 21 4.89543 21 6V18C21 19.1046 20.1046 20 19 20H5C3.89543 20 3 19.1046 3 18V6C3 4.89543 3.89543 4 5 4Z" stroke="currentColor" stroke-width="2"/>
            </svg>
            {{ products.length }} produit(s)
          </div>
        </div>
      </div>

      <div class="products-grid">
        <div 
          v-for="product in products" 
          :key="product.id" 
          :class="['product-card', { inactive: !product.is_active }]"
        >
          <div class="card-header">
            <h4 class="product-name">{{ product.name }}</h4>
            <div class="product-actions">
              <button @click="editProduct(product)" class="action-btn edit" title="Modifier">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  <path d="M18.5 2.5C18.8978 2.10217 19.4374 1.87868 20 1.87868C20.5626 1.87868 21.1022 2.10217 21.5 2.5C21.8978 2.89782 22.1213 3.43739 22.1213 4C22.1213 4.56261 21.8978 5.10217 21.5 5.5L12 15L8 16L9 12L18.5 2.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Modifier
              </button>
              <button @click="deleteProduct(product.id)" class="action-btn delete" title="Supprimer">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3 6H5H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.21071 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  <path d="M10 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  <path d="M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Supprimer
              </button>
            </div>
          </div>

          <div class="card-content">
            <div class="product-info">
              <p class="product-category">{{ product.category }}</p>
              <p v-if="product.description" class="product-description">
                {{ product.description }}
              </p>
            </div>

            <div class="product-details">
              <div class="detail-group">
                <div class="detail-item">
                  <span class="detail-label">Prix</span>
                  <span class="detail-value">{{ product.price }} DH</span>
                </div>
                <div class="detail-item">
                  <span class="detail-label">Stock</span>
                  <span :class="['detail-value', product.stock <= 5 ? 'low-stock' : '']">
                    {{ product.stock }}
                    <svg v-if="product.stock <= 5" width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="warning-icon">
                      <path d="M12 9V13M12 17H12.01M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="status-indicator">
              <span :class="['status', product.is_active ? 'active' : 'inactive']">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="12" cy="12" r="10" fill="currentColor"/>
                  <path v-if="product.is_active" d="M8 12L11 15L16 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path v-else d="M15 9L9 15M9 9L15 15" stroke="white" stroke-width="2" stroke-linecap="round"/>
                </svg>
                {{ product.is_active ? 'Actif' : 'Inactif' }}
              </span>
            </div>
            <div class="product-id">#{{ product.id }}</div>
          </div>
        </div>

        <div v-if="products.length === 0" class="empty-state">
          <div class="empty-icon">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 7L12 3L4 7M20 7L12 11M20 7V17L12 21M12 11V21M4 7V17L12 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <h4>Aucun produit enregistré</h4>
          <p>Commencez par ajouter votre premier produit</p>
          <button @click="showAddFormFromList" class="btn btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Ajouter un produit
          </button>
        </div>
      </div>
    </div>

    <div class="modal-overlay" v-if="editing">
      <div class="modal-content">
        <div class="modal-header">
          <h2>Modifier le produit</h2>
          <button @click="cancelEdit" class="close-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </button>
        </div>

        <form @submit.prevent="saveProduct" class="simple-form">
          <div class="form-grid">
            <div class="form-group">
              <label>Nom du produit *</label>
              <input 
                v-model="form.name" 
                placeholder="Nom du produit" 
                required 
                class="form-control"
              />
            </div>

            <div class="form-group">
              <label>Prix (DH) *</label>
              <input 
                v-model="form.price" 
                type="number" 
                placeholder="0.00" 
                required 
                class="form-control"
                step="0.01"
                min="0"
              />
            </div>

            <div class="form-group">
              <label>Stock *</label>
              <input 
                v-model="form.stock" 
                type="number" 
                placeholder="0" 
                required 
                class="form-control"
                min="0"
              />
            </div>

            <div class="form-group">
              <label>Catégorie *</label>
              <input 
                v-model="form.category" 
                placeholder="Catégorie" 
                required 
                class="form-control"
              />
            </div>

            <div class="form-group full-width">
              <label>Description</label>
              <textarea 
                v-model="form.description" 
                placeholder="Description du produit..." 
                rows="4"
                class="form-control textarea"
              ></textarea>
            </div>

            <div class="form-group">
              <label>Statut du produit</label>
              <div class="status-options">
                <label class="radio-option">
                  <input 
                    type="radio" 
                    v-model="form.is_active" 
                    :value="1"
                    class="radio-input"
                  />
                  <span class="radio-custom"></span>
                  <span class="radio-label">
                    <span class="status-active">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" fill="#10B981" stroke="#10B981" stroke-width="2"/>
                        <path d="M8 12L11 15L16 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      Actif
                    </span>
                  </span>
                </label>
                <label class="radio-option">
                  <input 
                    type="radio" 
                    v-model="form.is_active" 
                    :value="0"
                    class="radio-input"
                  />
                  <span class="radio-custom"></span>
                  <span class="radio-label">
                    <span class="status-inactive">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" fill="#EF4444" stroke="#EF4444" stroke-width="2"/>
                        <path d="M15 9L9 15M9 9L15 15" stroke="white" stroke-width="2" stroke-linecap="round"/>
                      </svg>
                      Inactif
                    </span>
                  </span>
                </label>
              </div>
            </div>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn btn-primary">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3H16.1716C16.702 3 17.2107 3.21071 17.5858 3.58579L20.4142 6.41421C20.7893 6.78929 21 7.29799 21 7.82843V19C21 20.1046 20.1046 21 19 21Z" stroke="currentColor" stroke-width="2"/>
                <path d="M17 21V13H7V21" stroke="currentColor" stroke-width="2"/>
                <path d="M7 3V8H15" stroke="currentColor" stroke-width="2"/>
              </svg>
              Mettre à jour
            </button>
            
            <button 
              @click="cancelEdit" 
              type="button" 
              class="btn btn-secondary"
            >
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
              Annuler
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "ProductCrud",

  data() {
    return {
      products: [],
      editing: false,
      showForm: false,
      showList: false,
      form: {
        name: "",
        price: "",
        stock: "",
        description: "",
        category: "",
        is_active: 1,
      },
      editId: null,
    };
  },

  mounted() {
    this.getProducts();
  },

  methods: {
    async getProducts() {
      try {
        const res = await axios.get("http://127.0.0.1:8000/api/products");
        this.products = res.data;
      } catch (error) {
        console.error("Erreur lors du chargement des produits:", error);
      }
    },

    async saveProduct() {
      try {
        if (this.editing) {
          await axios.put(`http://127.0.0.1:8000/api/products/${this.editId}`, this.form);
          this.cancelEdit();
        } else {
          await axios.post("http://127.0.0.1:8000/api/products", this.form);
          this.hideForm();
        }
        this.getProducts();
      } catch (error) {
        console.error("Erreur lors de la sauvegarde:", error);
      }
    },

    async deleteProduct(id) {
      if (confirm("Êtes-vous sûr de vouloir supprimer ce produit ?")) {
        try {
          await axios.delete(`http://127.0.0.1:8000/api/products/${id}`);
          this.getProducts();
        } catch (error) {
          console.error("Erreur lors de la suppression:", error);
        }
      }
    },

    editProduct(product) {
      this.editing = true;
      this.editId = product.id;
      this.form = { ...product };
    },

    cancelEdit() {
      this.editing = false;
      this.editId = null;
      this.resetForm();
    },

    resetForm() {
      this.form = {
        name: "",
        price: "",
        stock: "",
        description: "",
        category: "",
        is_active: 1,
      };
    },

    showAddForm() {
      this.showForm = true;
      this.showList = false;
      this.resetForm();
    },

    showAddFormFromList() {
      this.showForm = true;
      this.showList = false;
      this.resetForm();
    },

    hideForm() {
      this.showForm = false;
      this.resetForm();
    },

    showProductList() {
      this.showList = true;
      this.showForm = false;
      this.getProducts();
    },

    hideList() {
      this.showList = false;
    },
  },
};
</script>

<style scoped>
.full-width-container {
  min-height: 100vh;
  background: #f8fafc;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  width: 100%;
  margin: 0;
  padding: 0;
}

.simple-header {
  background: #158897;
  color: white;
  padding: 2.5rem 0;
  text-align: center;
  box-shadow: 0 4px 12px rgba(21, 136, 151, 0.2);
  width: 100%;
}

.simple-header h1 {
  font-size: 2.25rem;
  font-weight: 700;
  margin: 0 0 0.5rem 0;
  letter-spacing: -0.5px;
}

.simple-header p {
  margin: 0;
  font-size: 1.1rem;
  opacity: 0.9;
  font-weight: 300;
}

.main-actions {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 60vh;
  padding: 3rem;
  width: 100%;
}

.actions-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
  gap: 3rem;
  max-width: 1400px;
  width: 100%;
}

.action-card {
  background: white;
  border-radius: 20px;
  padding: 4rem 3rem;
  text-align: center;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 8px 30px rgba(21, 136, 151, 0.15);
  border: 2px solid transparent;
  position: relative;
  overflow: hidden;
}

.action-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 5px;
  background: linear-gradient(90deg, #158897, #22b8cf);
}

.action-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(21, 136, 151, 0.25);
  border-color: #158897;
}

.action-icon {
  margin-bottom: 2rem;
  color: #158897;
}

.action-icon svg {
  transition: transform 0.3s ease;
}

.action-card:hover .action-icon svg {
  transform: scale(1.1);
}

.action-card h3 {
  font-size: 1.8rem;
  font-weight: 600;
  color: #158897;
  margin: 0 0 1.5rem 0;
}

.action-card p {
  color: #718096;
  font-size: 1.2rem;
  line-height: 1.6;
  margin: 0;
}

.full-width-form {
  width: 100%;
  padding: 2rem;
}

.form-section {
  max-width: 1400px;
  margin: 0 auto;
}

.form-card {
  background: white;
  border-radius: 20px;
  padding: 3rem;
  box-shadow: 0 12px 35px rgba(21, 136, 151, 0.15);
  border: 1px solid #e1f5fe;
  position: relative;
  overflow: hidden;
}

.form-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 5px;
  background: linear-gradient(90deg, #158897, #22b8cf);
}

.form-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2.5rem;
  padding-bottom: 1.5rem;
  border-bottom: 1px solid #e1f5fe;
}

.form-header h2 {
  font-size: 2rem;
  font-weight: 600;
  color: #158897;
  margin: 0;
}

.close-btn {
  background: none;
  border: none;
  color: #718096;
  cursor: pointer;
  padding: 0.75rem;
  border-radius: 10px;
  transition: all 0.2s;
  display: flex;
  align-items: center;
  justify-content: center;
}

.close-btn:hover {
  background: #f7fafc;
  color: #158897;
}

.form-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 2rem;
  margin-bottom: 2rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.form-group.full-width {
  grid-column: 1 / -1;
}

.form-group label {
  font-size: 1rem;
  font-weight: 600;
  color: #2d3748;
}

.form-control {
  padding: 1.25rem 1.5rem;
  border: 2px solid #e2e8f0;
  border-radius: 12px;
  font-size: 1.1rem;
  transition: all 0.3s ease;
  background: white;
  width: 100%;
}

.form-control:focus {
  outline: none;
  border-color: #158897;
  box-shadow: 0 0 0 4px rgba(21, 136, 151, 0.1);
  transform: translateY(-2px);
}

.form-control.textarea {
  resize: vertical;
  min-height: 120px;
  font-family: inherit;
  line-height: 1.5;
}

.status-options {
  display: flex;
  gap: 2rem;
}

.radio-option {
  display: flex;
  align-items: center;
  gap: 1rem;
  cursor: pointer;
  padding: 1rem 1.5rem;
  border-radius: 12px;
  transition: all 0.3s ease;
  border: 2px solid transparent;
}

.radio-option:hover {
  background: #f7fafc;
  border-color: #e2e8f0;
}

.radio-input {
  display: none;
}

.radio-custom {
  width: 20px;
  height: 20px;
  border: 2px solid #cbd5e0;
  border-radius: 50%;
  position: relative;
  transition: all 0.3s ease;
}

.radio-input:checked + .radio-custom {
  border-color: #158897;
  background: #158897;
}

.radio-input:checked + .radio-custom::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 8px;
  height: 8px;
  background: white;
  border-radius: 50%;
}

.radio-label {
  font-size: 1rem;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.status-active, .status-inactive {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-weight: 600;
}

.status-active {
  color: #0a5c5c;
}

.status-inactive {
  color: #c53030;
}

.form-actions {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  margin-top: 2rem;
}

.btn {
  padding: 1.25rem 2.5rem;
  border: none;
  border-radius: 12px;
  font-weight: 600;
  font-size: 1.1rem;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 0.75rem;
}

.btn-primary {
  background: #158897;
  color: white;
  box-shadow: 0 6px 20px rgba(21, 136, 151, 0.3);
}

.btn-primary:hover {
  background: #117a8a;
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(21, 136, 151, 0.4);
}

.btn-secondary {
  background: white;
  color: #4a5568;
  border: 2px solid #e2e8f0;
}

.btn-secondary:hover {
  background: #f7fafc;
  border-color: #cbd5e0;
  transform: translateY(-2px);
}

.full-width-list {
  width: 100%;
  padding: 0;
}

.list-header {
  background: white;
  padding: 2.5rem 3rem;
  box-shadow: 0 4px 12px rgba(21, 136, 151, 0.15);
  border-bottom: 1px solid #e1f5fe;
  margin-bottom: 0;
}

.header-content {
  max-width: 1400px;
  margin: 0 auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.header-main {
  display: flex;
  align-items: center;
  gap: 2rem;
}

.header-main h2 {
  font-size: 2rem;
  font-weight: 600;
  color: #158897;
  margin: 0;
}

.back-btn {
  background: none;
  border: 2px solid #e2e8f0;
  color: #4a5568;
  padding: 1rem 2rem;
  border-radius: 12px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.back-btn:hover {
  background: #f7fafc;
  border-color: #158897;
  color: #158897;
  transform: translateY(-2px);
}

.total-count {
  background: rgba(21, 136, 151, 0.1);
  padding: 1rem 2rem;
  border-radius: 25px;
  font-size: 1rem;
  font-weight: 600;
  color: #158897;
  display: inline-flex;
  align-items: center;
  gap: 0.75rem;
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
  gap: 2rem;
  padding: 3rem;
  max-width: 1400px;
  margin: 0 auto;
}

.product-card {
  background: white;
  border-radius: 16px;
  padding: 2rem;
  box-shadow: 0 8px 25px rgba(21, 136, 151, 0.15);
  border: 1px solid #e1f5fe;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.product-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #158897, #22b8cf);
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 35px rgba(21, 136, 151, 0.2);
}

.product-card.inactive {
  background: #fff5f5;
  opacity: 0.8;
}

.card-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 1.5rem;
}

.product-name {
  font-size: 1.25rem;
  font-weight: 600;
  color: #2d3748;
  margin: 0;
  flex: 1;
}

.product-actions {
  display: flex;
  gap: 0.75rem;
}

.action-btn {
  padding: 0.5rem 1rem;
  border: 2px solid;
  border-radius: 8px;
  font-size: 0.8rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  background: white;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.action-btn.edit {
  color: #158897;
  border-color: #158897;
}

.action-btn.edit:hover {
  background: #158897;
  color: white;
  transform: translateY(-2px);
}

.action-btn.delete {
  color: #e53e3e;
  border-color: #e53e3e;
}

.action-btn.delete:hover {
  background: #e53e3e;
  color: white;
  transform: translateY(-2px);
}

.card-content {
  margin-bottom: 1.5rem;
}

.product-category {
  font-size: 0.9rem;
  color: #158897;
  margin: 0 0 1rem 0;
  font-weight: 600;
  background: rgba(21, 136, 151, 0.1);
  padding: 0.5rem 1rem;
  border-radius: 12px;
  display: inline-block;
}

.product-description {
  font-size: 0.9rem;
  color: #718096;
  line-height: 1.5;
  margin: 0 0 1.5rem 0;
}

.detail-group {
  display: flex;
  gap: 2rem;
}

.detail-item {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.detail-label {
  font-size: 0.75rem;
  color: #718096;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-weight: 500;
}

.detail-value {
  font-size: 1rem;
  font-weight: 700;
  color: #2d3748;
  display: flex;
  align-items: center;
  gap: 0.25rem;
}

.detail-value.low-stock {
  color: #e53e3e;
}

.warning-icon {
  color: #e53e3e;
}

.card-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 1rem;
  border-top: 1px solid #f1f5f9;
}

.status {
  padding: 0.5rem 1rem;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.status.active {
  background: rgba(72, 187, 120, 0.1);
  color: #38a169;
  border: 1px solid rgba(72, 187, 120, 0.3);
}

.status.inactive {
  background: rgba(229, 62, 62, 0.1);
  color: #e53e3e;
  border: 1px solid rgba(229, 62, 62, 0.3);
}

.product-id {
  font-size: 0.75rem;
  color: #9ca3af;
}

.empty-state {
  grid-column: 1 / -1;
  padding: 5rem 2rem;
  text-align: center;
  color: #718096;
}

.empty-icon {
  margin-bottom: 2rem;
  color: #cbd5e0;
}

.empty-state h4 {
  font-size: 1.5rem;
  margin: 0 0 1rem 0;
  color: #4a5568;
  font-weight: 600;
}

.empty-state p {
  margin: 0 0 2.5rem 0;
  font-size: 1.1rem;
  opacity: 0.8;
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
  padding: 2rem;
}

.modal-content {
  background: white;
  border-radius: 20px;
  padding: 2.5rem;
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
  border: 1px solid #e1f5fe;
  max-width: 800px;
  width: 100%;
  max-height: 90vh;
  overflow-y: auto;
  position: relative;
}

.modal-content::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 5px;
  background: linear-gradient(90deg, #158897, #22b8cf);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2.5rem;
  padding-bottom: 1.5rem;
  border-bottom: 1px solid #e1f5fe;
}

.modal-header h2 {
  font-size: 1.5rem;
  font-weight: 600;
  color: #158897;
  margin: 0;
}

@media (max-width: 768px) {
  .actions-container {
    grid-template-columns: 1fr;
  }
  
  .action-card {
    padding: 2.5rem 2rem;
  }
  
  .header-content {
    flex-direction: column;
    gap: 1.5rem;
    align-items: stretch;
  }
  
  .header-main {
    flex-direction: column;
    gap: 1rem;
  }
  
  .header-main h2 {
    text-align: center;
  }
  
  .products-grid {
    grid-template-columns: 1fr;
    padding: 1.5rem;
  }
  
  .form-grid {
    grid-template-columns: 1fr;
  }
  
  .detail-group {
    flex-direction: column;
    gap: 1rem;
  }
  
  .modal-overlay {
    padding: 1rem;
  }
  
  .modal-content {
    padding: 2rem;
  }
  
  .full-width-form {
    padding: 1rem;
  }
}
</style>